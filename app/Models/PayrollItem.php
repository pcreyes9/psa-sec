<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayrollItem extends Model
{
    protected $fillable = [

        'payroll_id',
        'employee_id',

        'days_present',

        'regular_hours',
        'overtime_hours',

        'daily_rate',
        'hourly_rate',

        'basic_pay',
        'overtime_pay',

        'allowances',

        'late_deduction',

        'gross_pay',
        'net_pay',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function payroll()
    {
        return $this->belongsTo(Payroll::class);
    }
}