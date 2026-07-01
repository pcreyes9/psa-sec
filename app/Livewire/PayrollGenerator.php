<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Payroll;
use App\Models\PayrollItem;
use App\Exports\PayrollExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;


class PayrollGenerator extends Component
{
    public $month;
    public $cutoff = 1;

    public $payrollItems = [];

    public $payrollExists = false;


    public function mount()
    {
        $this->month = now()->format('Y-m');

        $this->loadPayrollItems();
    }

    public function updated($property)
    {
        if (
            in_array($property, [
                'month',
                'cutoff'
            ])
        ) {
            $this->loadPayrollItems();
        }
    }

    public function loadPayrollItems()
    {
        $payrollCode =
            $this->month . '-C' . $this->cutoff;

        $this->payrollExists = Payroll::where(
            'payroll_code',
            $payrollCode
        )->exists();

        $this->payrollItems = PayrollItem::with(
                'employee'
            )
            ->where(
                'payroll_code',
                $payrollCode
            )
            ->get();
    }

    public function generatePayroll()
    {
        $payrollCode =
            $this->month . '-C' . $this->cutoff;

        $exists = Payroll::where(
            'payroll_code',
            $payrollCode
        )->exists();

        if ($exists) {

            session()->flash(
                'error',
                'Payroll already exists.'
            );

            return;
        }

        [$year, $month] = explode('-', $this->month);

        if ($this->cutoff == 1) {

            $dateFrom = Carbon::create(
                $year,
                $month,
                1
            );

            $dateTo = Carbon::create(
                $year,
                $month,
                15
            );

        } else {

            $dateFrom = Carbon::create(
                $year,
                $month,
                16
            );

            $dateTo = Carbon::create(
                $year,
                $month
            )->endOfMonth();

        }
        $payroll = Payroll::create([

            'payroll_code' => $payrollCode,

            'month' => $this->month,

            'cutoff' => $this->cutoff,

            'date_from' => $dateFrom,

            'date_to' => $dateTo,

            'total_amount' =>
                PayrollItem::where(
                    'payroll_code',
                    $payrollCode
                )->sum('net_pay'),

            'status' => 'Processed',
        ]);

        PayrollItem::where(
            'payroll_code',
            $payrollCode
        )->update([

            'payroll_id' => $payroll->id,

            'status' => 'Finalized',

        ]);

        $this->loadPayrollItems();

        session()->flash(
            'success',
            'Payroll generated successfully.'
        );
    }

    public function exportPayroll()
    {
        $payrollCode =
            $this->month . '-C' . $this->cutoff;

        $items = PayrollItem::with([
                'employee',
                'allowances',
                'deductions'
            ])
            ->where(
                'payroll_code',
                $payrollCode
            )
            ->get();

        return Excel::download(
            new PayrollExport(
                $items,
                $this->month,
                $this->cutoff
            ),
            "Payroll-{$payrollCode}.xlsx"
        );
    }

    public function render()
    {
        return view(
            'livewire.payroll-generator'
        );
    }
}