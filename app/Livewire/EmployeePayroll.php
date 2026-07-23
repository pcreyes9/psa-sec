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
use App\Models\PayrollItemAllowance;
use App\Models\PayrollItemDeduction;

class EmployeePayroll extends Component
{
    public $employees = [];
    public $attendanceRecords = [];
    public $deductionBreakdown = [];
    public $preparedPayrolls = [];
    public $overtimeDates = [];

    public $selectedEmployee = null;
    public $settings;

    public $month;
    public $cutoff = '1';

    // ATTENDANCE
    public $daysPresent = 0;
    public $lateMinutes = 0;

    // RATES
    public $dailyRate = 0;
    public $hourlyRate = 0;

    // BASIC PAY
    public $basicPay = 0;
    public $allowances = 0;

    public $deductions = 0;
    public $otherDeductions = 0;
    public $lateDeduction = 0;
    public $taxDeduction = 0;

    public $grossPay = 0;
    public $taxableIncome = 0;
    public $netPay = 0;

    // REGULAR HOURS
    public $regularHours = 0;
    public $weekendHours = 0;
    public $nonWorkingHolidayHours = 0;
    public $regHolidayHours = 0;

    // OVERTIME HOURS ONLY
    public $weekdayOtHours = 0;
    public $weekendOtHours = 0;
    public $nonWorkingHolidayOtHours = 0;
    public $regHolidayOtHours = 0;

    // OT + ND HOURS
    public $weekdayOtNdHours = 0;
    public $weekendOtNdHours = 0;
    public $nonWorkingHolidayOtNdHours = 0;
    public $regHolidayOtNdHours = 0;

    // PREMIUM PAY
    public $weekendPay = 0;
    public $nonWorkingHolidayPay = 0;
    public $regHolidayPay = 0;

    // OT PAY
    public $weekdayOtPay = 0;
    public $weekendOtPay = 0;
    public $nonWorkingHolidayOtPay = 0;
    public $regHolidayOtPay = 0;

    // OT + ND PAY
    public $weekdayOtNdPay = 0;
    public $weekendOtNdPay = 0;
    public $nonWorkingHolidayOtNdPay = 0;
    public $regHolidayOtNdPay = 0;

    public $payrollItem = null;

    // TOTAL PREMIUMS
    public $overtimePay = 0;

    public function mount()
    {
        $this->employees = Employee::with([
                'allowances',
                'deductions'
            ])
            ->where('status', 'Active')
            ->orderBy('id')
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
        
        $this->payrollItem = PayrollItem::where(
            'employee_id',
            $this->selectedEmployee->id
        )
        ->where(
            'payroll_code',
            $this->month . '-C' . $this->cutoff
        )
        ->first();
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
        $this->lateMinutes = 0;

        // REGULAR HOURS
        $this->regularHours = 0;
        $this->weekendHours = 0;
        $this->regHolidayHours = 0;
        $this->nonWorkingHolidayHours = 0;

        // OVERTIME HOURS ONLY
        $this->weekdayOtHours = 0;
        $this->weekendOtHours = 0;
        $this->regHolidayOtHours = 0;
        $this->nonWorkingHolidayOtHours = 0;

        // OT + NIGHT DIFFERENTIAL HOURS
        $this->weekdayOtNdHours = 0;
        $this->weekendOtNdHours = 0;
        $this->regHolidayOtNdHours = 0;
        $this->nonWorkingHolidayOtNdHours = 0;

        // PAY RATES
        $this->dailyRate = 0;
        $this->hourlyRate = 0;

        // BASIC PAY
        $this->basicPay = 0;

        // PREMIUM PAY
        $this->weekendPay = 0;
        $this->regHolidayPay = 0;
        $this->nonWorkingHolidayPay = 0;

        // OVERTIME PAY
        $this->weekdayOtPay = 0;
        $this->weekendOtPay = 0;
        $this->regHolidayOtPay = 0;
        $this->nonWorkingHolidayOtPay = 0;

        // OT + NIGHT DIFFERENTIAL PAY
        $this->weekdayOtNdPay = 0;
        $this->weekendOtNdPay = 0;
        $this->regHolidayOtNdPay = 0;
        $this->nonWorkingHolidayOtNdPay = 0;

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

        // OVERTIME DATES
        $this->overtimeDates = [];


        $workingHours = (float) $this->settings['working_hours_per_day'];

        // ==========================================
        // ATTENDANCE COMPUTATION
        // ==========================================

        [$year, $month] = explode('-', $this->month);

        $dateFrom = $this->cutoff == '1'
            ? Carbon::create($year, $month, 1)->startOfDay()
            : Carbon::create($year, $month, 16)->startOfDay();

        $dateTo = $this->cutoff == '1'
            ? Carbon::create($year, $month, 15)->endOfDay()
            : Carbon::create($year, $month)
                ->endOfMonth()
                ->endOfDay();

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

        $workingHours =
            $this->settings['working_hours_per_day'];

        foreach ($this->attendanceRecords as $att) {

            if (!$att->time_in || !$att->time_out) {
                continue;
            }

            // ======================================
            // DATETIME PREPARATION
            // ======================================

            $attendanceDate = Carbon::parse($att->attendance_date);

            $timeIn = Carbon::parse($att->time_in);
            $timeOut = Carbon::parse($att->time_out);

            // Overnight shift
            if ($timeOut->lt($timeIn)) {
                $timeOut->addDay();
            }

            $isWeekend = $attendanceDate->isWeekend();

            // ======================================
            // OFFICIAL SCHEDULE
            // ======================================

            $officialTimeIn = Carbon::parse(
                $attendanceDate->format('Y-m-d') . ' ' .
                $this->settings['official_time_in']
            );

            $officialTimeOut = Carbon::parse(
                $attendanceDate->format('Y-m-d') . ' ' .
                $this->settings['official_time_out']
            );

            if ($officialTimeOut->lte($officialTimeIn)) {
                $officialTimeOut->addDay();
            }

            $graceTime = Carbon::parse(
                $attendanceDate->format('Y-m-d') . ' ' .
                $this->settings['grace_period_time']
            );

            // ======================================
            // ADJUSTED TIME IN
            // Same logic used when saving attendance
            // ======================================

            $adjustedTimeIn = $timeIn->lte($graceTime)
                ? $officialTimeIn
                : $timeIn->copy();

            // ======================================
            // REGULAR & OT HOURS
            // Use saved computation
            // ======================================

            $regularHours = max(
                0,
                $att->total_hours - $att->overtime_hours
            );

            $otHours = $att->overtime_hours;

            // ======================================
            // NIGHT DIFFERENTIAL
            // 10:00 PM - 6:00 AM
            // ======================================

            $ndStart = $attendanceDate
                ->copy()
                ->setTime(22, 0);

            $ndEnd = $attendanceDate
                ->copy()
                ->addDay()
                ->setTime(6, 0);

            // Regular ND
            $regularNdStart = $adjustedTimeIn->max($ndStart);
            $regularNdEnd = $officialTimeOut->min($ndEnd);

            $regularNdHours = 0;

            if ($regularNdStart->lt($regularNdEnd)) {

                $regularNdHours = round(
                    $regularNdStart->diffInMinutes($regularNdEnd) / 60,
                    2
                );
            }

            // OT ND
            $otNdHours = 0;

            if ($otHours > 0) {

                $otStart = $officialTimeOut->copy();

                $otOverlapStart = $otStart->max($ndStart);
                $otOverlapEnd = $timeOut->min($ndEnd);

                if ($otOverlapStart->lt($otOverlapEnd)) {

                    $otNdHours = round(
                        $otOverlapStart
                            ->diffInMinutes($otOverlapEnd) / 60,
                        2
                    );
                }
            }

            // OT without ND
            $pureOtHours = max(
                0,
                $otHours - $otNdHours
            );

            // ======================================
            // CATEGORIZATION
            // ======================================

            if ($att->status === 'Regular Holiday') {

                $this->regHolidayHours += $regularHours;
                $this->regHolidayOtHours += $pureOtHours;
                $this->regHolidayOtNdHours += $otNdHours;

            } elseif ($att->status === 'Special Non-Working Holiday') {

                $this->nonWorkingHolidayHours += $regularHours;
                $this->nonWorkingHolidayOtHours += $pureOtHours;
                $this->nonWorkingHolidayOtNdHours += $otNdHours;

            } elseif ($isWeekend) {

                $this->weekendHours += $regularHours;
                $this->weekendOtHours += $pureOtHours;
                $this->weekendOtNdHours += $otNdHours;

            } else {

                $this->regularHours += $regularHours;
                $this->weekdayOtHours += $pureOtHours;
                $this->weekdayOtNdHours += $otNdHours;

            }

            // ======================================
            // LATE MINUTES
            // ======================================

            if ($timeIn->gt($graceTime)) {

                $this->lateMinutes +=
                    $graceTime->diffInMinutes($timeIn);

            }

            // ======================================
            // DAYS PRESENT
            // ======================================

            if (
                in_array(
                    $att->status,
                    [
                        'Present',
                        'Late',
                        'Half Day - VL',
                        'Half Day - SL',
                        'Regular Holiday',
                        'Special Non-Working Holiday',
                    ]
                )
            ) {
                $this->daysPresent++;
            }
        }

        // ==========================================
        // BASIC PAY COMPUTATION
        // ==========================================

        $annualSalary =
            $this->selectedEmployee
                ->monthly_salary * 12;

        $this->basicPay = round(
            $annualSalary / 24,
            2
        );

        $this->dailyRate = round(
            $annualSalary / 260,
            2
        );

        $this->hourlyRate = round(
            $this->dailyRate / 8,
            2
        );

        // ==========================================
        // PREMIUM PAY
        // ==========================================

        $this->weekendPay = round(
            $this->weekendHours *
            $this->hourlyRate *
            ($this->settings['weekend_rate'] / 100),
            2
        );

        $this->nonWorkingHolidayPay = round(
            $this->nonWorkingHolidayHours *
            $this->hourlyRate *
            ($this->settings['non_working_holiday_rate'] / 100),
            2
        );

        $this->regHolidayPay = round(
            $this->regHolidayHours *
            $this->hourlyRate *
            ($this->settings['reg_holiday_rate'] / 100),
            2
        );

        // ==========================================
        // OVERTIME PAY
        // ==========================================

        $this->weekdayOtPay = round(
            $this->weekdayOtHours *
            $this->hourlyRate *
            ($this->settings['weekday_ot_rate'] / 100),
            2
        );

        $this->weekendOtPay = round(
            $this->weekendOtHours *
            $this->hourlyRate *
            ($this->settings['weekend_ot_rate'] / 100),
            2
        );

        $this->nonWorkingHolidayOtPay = round(
            $this->nonWorkingHolidayOtHours *
            $this->hourlyRate *
            ($this->settings['non_working_holiday_ot_rate'] / 100),
            2
        );

        $this->regHolidayOtPay = round(
            $this->regHolidayOtHours *
            $this->hourlyRate *
            ($this->settings['reg_holiday_ot_rate'] / 100),
            2
        );

        // ==========================================
        // OT + NIGHT DIFFERENTIAL PAY
        // ==========================================

        $this->weekdayOtNdPay = round(
            $this->weekdayOtNdHours *
            $this->hourlyRate *
            ($this->settings['weekday_nd_rate'] / 100),
            2
        );

        $this->weekendOtNdPay = round(
            $this->weekendOtNdHours *
            $this->hourlyRate *
            ($this->settings['weekend_nd_rate'] / 100),
            2
        );

        $this->nonWorkingHolidayOtNdPay = round(
            $this->nonWorkingHolidayOtNdHours *
            $this->hourlyRate *
            ($this->settings['special_holiday_nd_rate'] / 100),
            2
        );

        $this->regHolidayOtNdPay = round(
            $this->regHolidayOtNdHours *
            $this->hourlyRate *
            ($this->settings['reg_holiday_nd_rate'] / 100),
            2
        );

        // ==========================================
        // TOTAL PREMIUM PAY
        // ==========================================

        $this->overtimePay = round(

            $this->weekendPay +
            // $this->nonWorkingHolidayPay +
            // $this->regHolidayPay +

            $this->weekdayOtPay +
            $this->weekendOtPay +
            $this->nonWorkingHolidayOtPay +
            $this->regHolidayOtPay +

            $this->weekdayOtNdPay +
            $this->weekendOtNdPay +
            $this->nonWorkingHolidayOtNdPay +
            $this->regHolidayOtNdPay,

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

        // $this->lateDeduction = round(
        //     ($this->lateMinutes / 60) *
        //     $this->hourlyRate,
        //     2
        // );

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
        
        // dd($this->deductions);

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


    public function createPayrollItem()
    {
        if (!$this->selectedEmployee) {
            return;
        }

        $payrollCode =
            $this->month . '-C' . $this->cutoff;

        // Prevent duplicate payroll item
        $exists = PayrollItem::where(
                'payroll_code', $payrollCode)
            ->where('employee_id', $this->selectedEmployee->id)->exists();

        if ($exists) {

            session()->flash(
                'error',
                'Payroll already exists for ' .  $this->month . ' - Cutoff ' . $this->cutoff . ' for ' . $this->selectedEmployee->name
            );

            return;
        }
        // dd($this->deductions - $this->taxDeduction);
        $payrollItem = PayrollItem::create([

            'payroll_id' => null,

            'payroll_code' => $payrollCode,

            'month' => $this->month,

            'cutoff' => $this->cutoff,

            'employee_id' =>
                $this->selectedEmployee->id,

                // 'days_present' =>
            //     $this->daysPresent,

            // 'regular_hours' =>
            //     $this->regularHours,

            // 'overtime_hours' =>
            //     $this->overtimeHours,

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
                $this->deductions - $this->taxDeduction,

            'tax_deduction' =>
                $this->taxDeduction,

            'gross_pay' =>
                $this->grossPay,

            'net_pay' =>
                $this->netPay,

            'status' => 'Draft',
        ]);

        // dd($this->selectedEmployee->allowances);
        foreach ($this->selectedEmployee->allowances as $allowance) {
            // dd($allowance);
            PayrollItemAllowance::create([

                'payroll_item_id' =>
                    $payrollItem->id,

                'allowance_name' =>
                    $allowance->name,

                'amount' =>
                    $allowance->amount / 2,

            ]);
        }

        foreach ($this->deductionBreakdown as $deduction) {

            if ($deduction['amount'] <= 0) {
                continue;
            }

            PayrollItemDeduction::create([

                'payroll_item_id' =>
                    $payrollItem->id,

                'deduction_name' =>
                    $deduction['name'],

                'deduction_type' =>
                    $deduction['type'],

                'amount' =>
                    $deduction['amount'],

            ]);
        }

        session()->flash(
            'success',
            'Payroll item created successfully for ' . $this->selectedEmployee->name
        );
    }

    public function render()
    {
        return view('livewire.employee-payroll');
    }
}