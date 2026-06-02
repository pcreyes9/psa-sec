<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\Payroll;
use App\Models\PayrollItem;
use Carbon\Carbon;

class PayrollGenerator extends Component
{
    public $month;
    public $cutoff = '1';

    public $generatedPayroll = null;
    public $payrollItems = [];

    public function mount()
    {
        $this->month = now()->format('Y-m');
    }

    public function generatePayroll()
    {
        [$year, $month] = explode('-', $this->month);

        /*
        |--------------------------------------------------------------------------
        | DETERMINE CUTOFF DATES
        |--------------------------------------------------------------------------
        */

        if ($this->cutoff == '1') {

            $dateFrom = Carbon::create($year, $month, 1)
                ->startOfDay();

            $dateTo = Carbon::create($year, $month, 15)
                ->endOfDay();

        } else {

            $dateFrom = Carbon::create($year, $month, 16)
                ->startOfDay();

            $dateTo = Carbon::create($year, $month)
                ->endOfMonth()
                ->endOfDay();
        }

        /*
        |--------------------------------------------------------------------------
        | CREATE PAYROLL
        |--------------------------------------------------------------------------
        */

        $payroll = Payroll::create([

            'payroll_code' =>
                'PAY-' .
                now()->format('YmdHis'),

            'month' => $this->month,

            'cutoff' => $this->cutoff,

            'date_from' => $dateFrom,
            'date_to' => $dateTo,

            'total_amount' => 0,

            'status' => 'Draft',
        ]);

        $grandTotal = 0;

        /*
        |--------------------------------------------------------------------------
        | LOOP EMPLOYEES
        |--------------------------------------------------------------------------
        */

        foreach (Employee::all() as $employee) {

            $attendanceRecords = Attendance::where(
                    'employee_id',
                    $employee->id
                )
                ->whereBetween('attendance_date', [
                    $dateFrom->toDateString(),
                    $dateTo->toDateString()
                ])
                ->get();

            /*
            |--------------------------------------------------------------------------
            | COMPUTATIONS
            |--------------------------------------------------------------------------
            */

            $daysPresent = 0;

            $regularHours = 0;
            $overtimeHours = 0;

            $lateMinutes = 0;

            foreach ($attendanceRecords as $att) {

                if (!$att->time_in || !$att->time_out) {
                    continue;
                }

                $timeIn = Carbon::parse($att->time_in);
                $timeOut = Carbon::parse($att->time_out);

                /*
                |--------------------------------------------------------------------------
                | TOTAL HOURS
                |--------------------------------------------------------------------------
                */

                $hours = round(
                    $timeIn->diffInMinutes($timeOut) / 60,
                    2
                );

                /*
                |--------------------------------------------------------------------------
                | REGULAR HOURS
                |--------------------------------------------------------------------------
                */

                $regularHours += min($hours, 10);

                /*
                |--------------------------------------------------------------------------
                | OVERTIME
                |--------------------------------------------------------------------------
                */

                $computedOT = max(0, $hours - 10);

                $ot = $computedOT > 1
                    ? $computedOT
                    : 0;

                $overtimeHours += $ot;

                /*
                |--------------------------------------------------------------------------
                | LATE
                |--------------------------------------------------------------------------
                */

                $graceTime = Carbon::parse($att->attendance_date)
                    ->setTime(8, 15);

                if ($timeIn->greaterThan($graceTime)) {

                    $lateMinutes +=
                        $graceTime->diffInMinutes($timeIn);
                }

                /*
                |--------------------------------------------------------------------------
                | PRESENT DAYS
                |--------------------------------------------------------------------------
                */

                if (
                    in_array($att->status, [
                        'Present',
                        'Late'
                    ])
                ) {
                    $daysPresent++;
                }
            }

            /*
            |--------------------------------------------------------------------------
            | RATES
            |--------------------------------------------------------------------------
            */

            $dailyRate = round(
                $employee->monthly_salary / 22,
                2
            );

            $hourlyRate = round(
                $dailyRate / 10,
                2
            );

            /*
            |--------------------------------------------------------------------------
            | PAY
            |--------------------------------------------------------------------------
            */

            $basicPay = round(
                $regularHours * $hourlyRate,
                2
            );

            $overtimePay = round(
                $overtimeHours *
                $hourlyRate *
                1.25,
                2
            );

            /*
            |--------------------------------------------------------------------------
            | LATE DEDUCTION
            |--------------------------------------------------------------------------
            */

            $lateDeduction = round(
                ($lateMinutes / 60) * $hourlyRate,
                2
            );

            /*
            |--------------------------------------------------------------------------
            | GROSS & NET
            |--------------------------------------------------------------------------
            */

            $allowances = $employee->allowances()
                ->where('is_active', 1)
                ->sum('amount');
            // dd($allowances);

            $grossPay =
                $basicPay +
                $overtimePay +
                $allowances;

            $netPay =
                $grossPay -
                $lateDeduction;

            /*
            |--------------------------------------------------------------------------
            | SAVE PAYROLL ITEM
            |--------------------------------------------------------------------------
            */

            PayrollItem::create([

                'payroll_id' => $payroll->id,
                'employee_id' => $employee->id,

                'days_present' => $daysPresent,

                'regular_hours' => round($regularHours, 2),
                'overtime_hours' => round($overtimeHours, 2),

                'daily_rate' => $dailyRate,
                'hourly_rate' => $hourlyRate,

                'basic_pay' => $basicPay,
                'overtime_pay' => $overtimePay,

                'allowances' => $allowances,

                'late_deduction' => $lateDeduction,

                'gross_pay' => $grossPay,
                'net_pay' => $netPay,
            ]);

            $grandTotal += $netPay;
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE TOTAL PAYROLL
        |--------------------------------------------------------------------------
        */

        $payroll->update([
            'total_amount' => round($grandTotal, 2)
        ]);

        /*
        |--------------------------------------------------------------------------
        | LOAD RESULTS
        |--------------------------------------------------------------------------
        */

        $this->generatedPayroll = $payroll;

        $this->payrollItems = PayrollItem::with('employee')
            ->where('payroll_id', $payroll->id)
            ->get();
        // dd($this->payrollItems);
    }

    public function render()
    {
        return view('livewire.payroll-generator');
    }
}