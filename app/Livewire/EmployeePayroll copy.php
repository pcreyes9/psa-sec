<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\Payroll;
use App\Models\PayrollItem;
use App\Models\TaxBracket;
use Carbon\Carbon;
use App\Models\Setting;

class EmployeePayroll extends Component
{
    public $employees = [], $attendanceRecords = [], $deductionBreakdown = [], $preparedPayrolls = [];
    public $selectedEmployee = null;
    public $month, $cutoff = '1';
    public $daysPresent = 0, $regularHours = 0, $overtimeHours = 0, $lateMinutes = 0;
    public $dailyRate = 0, $hourlyRate = 0;
    public $basicPay = 0, $overtimePay = 0, $allowances = 0;
    public $deductions = 0, $otherDeductions = 0, $lateDeduction = 0;
    public $grossPay = 0, $taxableIncome = 0, $netPay = 0;
    public $taxDeduction = 0;

    public $weekdayOtHours = 0;
    public $weekendOtHours = 0;
    public $nightDiffHours = 0;

    public $weekdayOtPay = 0;
    public $weekendOtPay = 0;
    public $nightDiffPay = 0;

    public $regHolidayHours = 0;
    public $nonWorkingHolidayHours = 0;

    public $regHolidayOT = 0;
    public $nonWorkingHolidayOT = 0;

    public $regHolidayPay = 0;
    public $nonWorkingHolidayPay = 0;

    public $regHolidayOTPay = 0;
    public $nonWorkingHolidayOTPay = 0;

    public $weekdayNdHours = 0;
    public $weekendNdHours = 0;
    public $regHolidayNdHours = 0;
    public $specialHolidayNdHours = 0;

    public $weekdayNdPay = 0;
    public $weekendNdPay = 0;
    public $regHolidayNdPay = 0;
    public $specialHolidayNdPay = 0;
    
    public $overtimeDates = [];

    public $settings;

    public function mount()
    {
        $this->employees = Employee::with([
                'allowances',
                'deductions'
            ])
            ->orderBy('name')
            ->get();

        $this->month = now()->format('Y-m');

        $this->settings = Setting::pluck(
            'value',
            'key'
        );
    }

    public function selectEmployee($id)
    {
        $this->selectedEmployee = Employee::with([
                'allowances',
                'deductions'
            ])
            ->findOrFail($id);

        $this->computePayroll();
    }

    public function updated($property)
    {
        if (
            in_array($property, [
                'month',
                'cutoff'
            ]) &&
            $this->selectedEmployee
        ) {
            $this->computePayroll();
        }
    }

    public function computePayroll()
    {
        if (!$this->selectedEmployee) {
            return;
        }

        // ATTENDANCE
        $this->daysPresent = 0;
        $this->regularHours = 0;
        $this->lateMinutes = 0;

        // OVERTIME HOURS
        $this->weekdayOtHours = 0;
        $this->weekendOtHours = 0;

        // NIGHT DIFFERENTIAL HOURS
        $this->weekdayNdHours = 0;
        $this->weekendNdHours = 0;
        $this->regHolidayNdHours = 0;
        $this->specialHolidayNdHours = 0;

        // HOLIDAY HOURS
        $this->regHolidayHours = 0;
        $this->regHolidayOT = 0;

        $this->nonWorkingHolidayHours = 0;
        $this->nonWorkingHolidayOT = 0;

        // PAY RATES
        $this->dailyRate = 0;
        $this->hourlyRate = 0;

        // BASIC PAY
        $this->basicPay = 0;

        // OT PAY
        $this->weekdayOtPay = 0;
        $this->weekendOtPay = 0;

        // NIGHT DIFFERENTIAL PAY
        $this->weekdayNdPay = 0;
        $this->weekendNdPay = 0;
        $this->regHolidayNdPay = 0;
        $this->specialHolidayNdPay = 0;

        // HOLIDAY PAY
        $this->regHolidayPay = 0;
        $this->regHolidayOTPay = 0;

        $this->nonWorkingHolidayPay = 0;
        $this->nonWorkingHolidayOTPay = 0;

        // TOTAL PREMIUMS
        $this->overtimePay = 0;

        // ALLOWANCES
        $this->allowances = 0;

        // DEDUCTIONS
        $this->deductions = 0;
        $this->otherDeductions = 0;
        $this->lateDeduction = 0;

        $this->deductionBreakdown = [];

        // TAX
        $this->taxableIncome = 0;
        $this->taxDeduction = 0;

        // PAYROLL TOTALS
        $this->grossPay = 0;
        $this->netPay = 0;


        // ATTENDANCE COMPUTATION
        [$year, $month] = explode('-', $this->month);

        $dateFrom = $this->cutoff == '1'
        ? Carbon::create($year, $month, 1)->startOfDay()
        : Carbon::create($year, $month, 16)->startOfDay();

        $dateTo = $this->cutoff == '1'
        ? Carbon::create($year, $month, 15)->endOfDay()
        : Carbon::create($year, $month)->endOfMonth()->endOfDay();

        $this->attendanceRecords = Attendance::where(
            'employee_id',
            $this->selectedEmployee->id
        )
        ->whereBetween('attendance_date', [
        $dateFrom->toDateString(),
        $dateTo->toDateString(),
        ])
        ->orderBy('attendance_date')
        ->get();

        if ($this->attendanceRecords->isEmpty()) {
            return;
        }

        foreach ($this->attendanceRecords as $att) {

            if (!$att->time_in || !$att->time_out) {
                continue;
            }

            $timeIn = Carbon::parse($att->time_in);
            $timeOut = Carbon::parse($att->time_out);

            $hours = round(
                $timeIn->diffInMinutes($timeOut) / 60,
                2
            );

            $attendanceDate = Carbon::parse(
                $att->attendance_date
            );

            $isWeekend = $attendanceDate->isWeekend();

            // HOURS RATES

            if ($att->status == 'Regular Holiday') {

                $regularHours = min($hours, $this->settings['working_hours_per_day']);

                $this->regHolidayHours +=
                    $regularHours;

                $holidayOT = max(
                    0,
                    $hours - $this->settings['working_hours_per_day']
                );

                $this->regHolidayOT +=
                    $holidayOT;

            } elseif (
                $att->status ==
                'Special Non-Working Holiday'
            ) {

                $regularHours = min($hours, $this->settings['working_hours_per_day']);

                $this->nonWorkingHolidayHours +=
                    $regularHours;

                $specialOT = max(
                    0,
                    $hours - $this->settings['working_hours_per_day']
                );

                $this->nonWorkingHolidayOT +=
                    $specialOT;

            } elseif ($isWeekend) {

                $this->weekendOtHours +=
                    $hours;

            } else {

                $regularHours = min(
                    $hours,
                    $this->settings['working_hours_per_day']
                );

                $this->regularHours +=
                    $regularHours;

                $weekdayOT = max(
                    0,
                    $hours - $this->settings['working_hours_per_day']
                );

                $this->weekdayOtHours +=
                    $weekdayOT;
            }

            // NIGHT DIFFERENTIAL
            $nightStart = Carbon::parse(
                $att->attendance_date
            )->setTimeFromTimeString(
                $this->settings['night_diff_start']
            );

            if ($timeOut->greaterThan($nightStart)) {

                $nightWorkStart =
                    $timeIn->greaterThan($nightStart)
                        ? $timeIn
                        : $nightStart;

                $ndHours = round(
                    $nightWorkStart
                        ->diffInMinutes($timeOut) / 60,
                    2
                );

                if ($att->status == 'Regular Holiday') {

                    $this->regHolidayNdHours +=
                        $ndHours;

                } elseif (
                    $att->status ==
                    'Special Non-Working Holiday'
                ) {

                    $this->specialHolidayNdHours +=
                        $ndHours;

                } elseif ($isWeekend) {

                    $this->weekendNdHours +=
                        $ndHours;

                } else {

                    $this->weekdayNdHours +=
                        $ndHours;
                }
            }

            // LATE COMPUTATION

            $graceTime = Carbon::parse(
                $att->attendance_date
            )->setTimeFromTimeString(
                $this->settings['grace_period_time']
            );

            if ($timeIn->greaterThan($graceTime)) {

                $this->lateMinutes +=
                    $graceTime->diffInMinutes(
                        $timeIn
                    );
            }

            if (
                in_array(
                    $att->status,
                    [
                        'Present',
                        'Late',
                        'Regular Holiday',
                        'Non Working Holiday'
                    ]
                )
            ) {
                $this->daysPresent++;
            }
        }

        // BASIC PAY COMPUTATION
        $annualSalary =
        $this->selectedEmployee->monthly_salary * 12;

        $this->basicPay = round(
        $annualSalary / 24,
        2
        );

        $this->dailyRate = round(
        $annualSalary / 260,
        2
        );

        $this->hourlyRate = round(
        $this->dailyRate / 
        8,
        // $this->settings['working_hours_per_day'],
        2
        );

        // OT PAY
        $this->weekdayOtPay = round(
        $this->weekdayOtHours *
        $this->hourlyRate *
        ($this->settings['weekday_ot_rate'] / 100),
        2
        );

        // dd($this->weekdayOtHours, $this->hourlyRate, ($this->settings['weekday_ot_rate'] * 100));

        $this->weekendOtPay = round(
        $this->weekendOtHours *
        $this->hourlyRate *
        ($this->settings['weekend_ot_rate'] / 100),
        2
        );

        // NIGHT DIFFERENTIAL PAY
        $this->weekdayNdPay = round(
        $this->weekdayNdHours *
        $this->hourlyRate *
        (($this->settings['weekday_ot_rate'] / 100) * (($this->settings['night_diff_rate'] + 100) / 100)),
        2
        );

        // dd((($this->settings['weekday_ot_rate'] / 100) * (($this->settings['night_diff_rate'] + 100) / 100)));

        $this->weekendNdPay = round(
        $this->weekendNdHours *
        $this->hourlyRate *
        ((($this->settings['weekend_ot_rate'] / 100) * (($this->settings['night_diff_rate'] + 100) / 100)) * 1.30),
        2
        );

        $this->regHolidayNdPay = round(
        $this->regHolidayNdHours *
        $this->hourlyRate *
        ((($this->settings['reg_holiday_rate'] / 100) * (($this->settings['night_diff_rate'] + 100) / 100)) * 1.30),
        2
        );

        $this->specialHolidayNdPay = round(
        $this->specialHolidayNdHours *
        $this->hourlyRate *
        (($this->settings['reg_holidaynon_working_holiday_rate_rate'] / 100) * (($this->settings['night_diff_rate'] + 100) / 100)),
        2
        );

        // HOLIDAY PAY
        $this->regHolidayPay = round(
        $this->regHolidayHours *
        $this->hourlyRate *
        ($this->settings['reg_holiday_rate'] / 100),
        2
        );

        $this->regHolidayOTPay = round(
        $this->regHolidayOT *
        $this->hourlyRate *
        ((($this->settings['reg_holiday_rate']) / 100) * 1.30),
        2
        );

        $this->nonWorkingHolidayPay = round(
        $this->nonWorkingHolidayHours *
        $this->hourlyRate *
        ((($this->settings['non_working_holiday_rate']) / 100) * 1.30),
        ($this->settings['non_working_holiday_rate'] / 100),
        2
        );

        $this->nonWorkingHolidayOTPay = round(
        $this->nonWorkingHolidayOT *
        $this->hourlyRate *
        ((($this->settings['non_working_holiday_rate']) / 100) * 1.30),
        2
        );


        // TOTAL PREMIUM PAY
        $this->overtimePay = round(
        
        $this->weekdayOtPay +
        $this->weekendOtPay +

        $this->weekdayNdPay +
        $this->weekendNdPay +
        $this->regHolidayNdPay +
        $this->specialHolidayNdPay +

        $this->regHolidayPay +
        $this->regHolidayOTPay +

        $this->nonWorkingHolidayPay +
        $this->nonWorkingHolidayOTPay, 
        2
        );

        // dd($this->hourlyRate, $this->regHolidayOT, $this->regHolidayPay);


        // dd($this->overtimePay);

        
        $monthlyAllowances = 0;

        foreach ($this->selectedEmployee->allowances as $allowance) {

            if (!$allowance->is_active) {
                continue;
            }

            $monthlyAllowances += $allowance->amount;
        }

        $this->allowances = round(
            $monthlyAllowances / 2,
            2
        );

        $this->lateDeduction = round(
            ($this->lateMinutes / 60) *
            $this->hourlyRate,
            2
        );

        $monthlyDeductions = 0;

        foreach ($this->selectedEmployee->deductions as $deduction) {

            if (!$deduction->is_active) {
                continue;
            }

            $amount =
                $this->cutoff == '1'
                    ? $deduction->amount
                    : 0;

            $monthlyDeductions += $amount;

            $this->deductionBreakdown[] = [
                'name' => $deduction->name,
                'type' => $deduction->type,
                'amount' => $amount,
            ];
        }

        $this->otherDeductions = round(
            $monthlyDeductions,
            2
        );
        
        $this->deductions = round(
            $this->lateDeduction +
            $this->otherDeductions,
            2
        );

        $this->grossPay = round(
            $this->basicPay +
            $this->overtimePay +
            $this->allowances,
            2
        );

        // TAX COMPUTATION
        $this->taxableIncome = round(
            $this->basicPay +
            $this->overtimePay -
            $this->deductions,
            2
        );

        // dd($this->taxableIncome);

        $bracket = TaxBracket::query()
            ->where('min_amount', '<=', $this->taxableIncome)
            ->where('max_amount', '>=', $this->taxableIncome)
            // ->where(function ($query) {

            //     $query->whereNull('max_amount')
            //         ->orWhere(
            //             'max_amount',
            //             '>=',
            //             $this->taxableIncome
            //         );

            // })
            ->first();

        if ($bracket) {
            $this->taxDeduction =
                $bracket->computeTax(
                    $this->taxableIncome
                );
        }
        
        $netBeforeAllowances = round(
            $this->taxableIncome -
            $this->taxDeduction,
            2
        );

        $this->deductions = round(
            $this->deductions +
            $this->taxDeduction,
            2
        );

        $this->netPay = round(
            $netBeforeAllowances +
            $this->allowances,
            2
        );
    
        // dd($this->netPay);
        // dd($this->attendanceRecords->isEmpty());
    }


    public function approvePayroll()
    {
        if (!$this->selectedEmployee) {
            return;
        }

        $this->preparedPayrolls[
            $this->selectedEmployee->id
        ] = [

            'employee_id' =>
                $this->selectedEmployee->id,

            'days_present' =>
                $this->daysPresent,

            'regular_hours' =>
                $this->regularHours,

            'overtime_hours' =>
                $this->overtimeHours,

            'daily_rate' =>
                $this->dailyRate,

            'hourly_rate' =>
                $this->hourlyRate,

            'basic_pay' =>
                $this->basicPay,

            'overtime_pay' =>
                $this->overtimePay,

            'allowances' =>
                $this->allowances,

            'late_deduction' =>
                $this->lateDeduction,

            'other_deductions' =>
                $this->otherDeductions,

            'tax_deduction' => 
                $this->taxDeduction,

            'gross_pay' =>
                $this->grossPay,

            'net_pay' =>
                $this->netPay,
        ];

        session()->flash(
            'success',
            'Payroll approved successfully.'
        );
    }

    public function finalizePayroll()
    {
        if (count($this->preparedPayrolls) == 0) {
            return;
        }

        $payroll = Payroll::create([

            'payroll_code' =>
                'PAY-' . now()->format('YmdHis'),

            'month' => $this->month,

            'cutoff' => $this->cutoff,

            'total_amount' => collect(
                $this->preparedPayrolls
            )->sum('net_pay'),

            'status' => 'Finalized',
        ]);

        foreach ($this->preparedPayrolls as $item) {

            PayrollItem::create([

                'payroll_id' => $payroll->id,

                'employee_id' => $item['employee_id'],

                'days_present' => $item['days_present'],

                'regular_hours' => $item['regular_hours'],

                'overtime_hours' => $item['overtime_hours'],

                'daily_rate' => $item['daily_rate'],

                'hourly_rate' => $item['hourly_rate'],

                'basic_pay' => $item['basic_pay'],

                'overtime_pay' => $item['overtime_pay'],

                'allowances' => $item['allowances'],

                'late_deduction' => $item['late_deduction'],
                
                'tax_deduction' => $item['tax_deduction'],

                'gross_pay' => $item['gross_pay'],

                'net_pay' => $item['net_pay'],
            ]);
        }

        session()->flash(
            'success',
            'Payroll finalized successfully.'
        );
    }

    public function render()
    {
        return view('livewire.employee-payroll');
    }
}