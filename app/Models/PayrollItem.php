<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayrollItem extends Model
{
    protected $fillable = [

        'payroll_code',
        'payroll_id',
        'employee_id',

        'month',
        'cutoff',

        'regular_hours',
        'overtime_hours',

        'daily_rate',
        'hourly_rate',

        'basic_pay',
        'overtime_pay',

        'allowances',

        'late_deduction',
        'other_deductions',
        'tax_deduction',

        'gross_pay',
        'net_pay',
    ];

    public function payroll()
    {
        return $this->belongsTo(
            Payroll::class
        );
    }

    public function employee()
    {
        return $this->belongsTo(
            Employee::class
        );
    }
    
    public function allowanceItems()
    {
        return $this->hasMany(
            PayrollItemAllowance::class,
            'payroll_item_id'
        );
    }

    public function deductionItems()
    {
        return $this->hasMany(
            PayrollItemDeduction::class,
            'payroll_item_id'
        );
    }
}