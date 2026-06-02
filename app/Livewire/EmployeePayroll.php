<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\Payroll;
use App\Models\PayrollItem;
use App\Models\TaxBracket;
use Carbon\Carbon;

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

    public $overtimeDates = [];

    public function mount()
    {
        $this->employees = Employee::with([
                'allowances',
                'deductions'
            ])
            ->orderBy('name')
            ->get();

        $this->month = now()->format('Y-m');
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

        $this->daysPresent = 0;
        $this->regularHours = 0;
        $this->overtimeHours = 0;
        $this->lateMinutes = 0;

        $this->dailyRate = 0;
        $this->hourlyRate = 0;

        $this->basicPay = 0;
        $this->overtimePay = 0;
        $this->allowances = 0;

        $this->deductions = 0;
        $this->otherDeductions = 0;
        $this->lateDeduction = 0;

        $this->grossPay = 0;
        $this->taxableIncome = 0;
        $this->taxDeduction = 0;
        $this->netPay = 0;

        $this->weekdayOtHours = 0;
        $this->weekendOtHours = 0;
        $this->nightDiffHours = 0;

        $this->weekdayOtPay = 0;
        $this->weekendOtPay = 0;
        $this->nightDiffPay = 0;

        $this->deductionBreakdown = [];


        // ATTENDANCE COMPUTATION
        [$year, $month] = explode('-', $this->month);

        if ($this->cutoff == '1') {

            $dateFrom = Carbon::create($year, $month, 1)->startOfDay();
            $dateTo = Carbon::create($year, $month, 15)->endOfDay();

        } else {

            $dateFrom = Carbon::create($year, $month, 16)->startOfDay();
            $dateTo = Carbon::create($year, $month)->endOfMonth()->endOfDay();
        }

        $this->attendanceRecords = Attendance::where(
                'employee_id',
                $this->selectedEmployee->id
            )
            ->whereBetween('attendance_date', [
                $dateFrom->toDateString(),
                $dateTo->toDateString()
            ])
            ->orderBy('attendance_date')
            ->get();

        if($this->attendanceRecords->isEmpty()) {
            return;
        }
        
        // dd($this->attendanceRecords->isEmpty());

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

            // dd($att->attendance_date, $hours);   

            $isWeekend = Carbon::parse(
                $att->attendance_date
            )->isWeekend();

            if ($isWeekend) {

                $ot = $hours;

                $this->weekendOtHours += $ot;

            } else {

                $this->regularHours += min(
                    $hours,
                    10
                );

                $computedOT = max(
                    0,
                    $hours - 10
                );

                $ot = $computedOT > 1
                    ? $computedOT
                    : 0;

                $this->weekdayOtHours += $ot;
            }

            if ($ot > 0) {

                $this->overtimeDates[] = [

                    'date' => $att->attendance_date,

                    'day' => Carbon::parse(
                        $att->attendance_date
                    )->format('l'),

                    'hours' => round($ot, 2),

                    'type' => $isWeekend
                        ? 'Weekend OT'
                        : 'Weekday OT',
                ];
            }

            $nightStart = Carbon::parse(
                $att->attendance_date
            )->setTime(22, 0);

            if ($timeOut->greaterThan($nightStart)) {

                $nightWorkStart =
                    $timeIn->greaterThan($nightStart)
                        ? $timeIn
                        : $nightStart;

                $nightMinutes =
                    $nightWorkStart->diffInMinutes(
                        $timeOut
                    );

                $this->nightDiffHours += round(
                    $nightMinutes / 60,
                    2
                );
            }

            $graceTime = Carbon::parse(
                $att->attendance_date
            )->setTime(8, 15);

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
                        'Late'
                    ]
                )
            ) {
                $this->daysPresent++;
            }

        }

        // dd($this->weekendOtHours);

        // BASIC PAY COMPUTATION
        $annualSalary = $this->selectedEmployee->monthly_salary * 12;

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

        $this->weekdayOtPay = round(
            $this->weekdayOtHours *
            $this->hourlyRate *
            1.25,
            2
        );

        $this->weekendOtPay = round(
            $this->weekendOtHours *
            $this->hourlyRate * 
            1.30,
            2
        );

        $this->nightDiffPay = round(
            $this->nightDiffHours *
            $this->hourlyRate *
            0.10,
            2
        );

        $this->overtimePay = round(
            $this->weekdayOtPay +
            $this->weekendOtPay +
            $this->nightDiffPay,

            2
        );


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