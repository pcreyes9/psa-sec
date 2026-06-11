<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Payroll;
use App\Models\PayrollItem;

class PayrollGenerator extends Component
{
    public $month;
    public $cutoff = 1;

    public $payrollItems = [];

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

        $this->payrollItems = PayrollItem::with(
                'employee'
            )
            ->where(
                'payroll_code',
                $payrollCode
            )
            ->where(
                'status',
                'Draft'
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

        $payroll = Payroll::create([

            'payroll_code' => $payrollCode,

            'month' => $this->month,

            'cutoff' => $this->cutoff,

            'total_amount' =>
                PayrollItem::where(
                    'payroll_code',
                    $payrollCode
                )->sum('net_pay'),

            'status' => 'Finalized',
        ]);

        PayrollItem::where(
            'payroll_code',
            $payrollCode
        )->update([

            'payroll_id' =>
                $payroll->id,

            'status' =>
                'Finalized',

        ]);

        $this->loadPayrollItems();

        session()->flash(
            'success',
            'Payroll generated successfully.'
        );
    }

    public function render()
    {
        return view(
            'livewire.payroll-generator'
        );
    }
}