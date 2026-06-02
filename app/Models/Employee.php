<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Attendance;
use App\Models\PayrollItem;

class Employee extends Model
{
    protected $fillable = [
        'employee_code',
        'name',
        'email',
        'phone_number',
        'department',
        'position',
        'monthly_salary',
        'hiring_date',
        'sss_no',
        'philhealth_no',
        'tin_no',
        'pagibig_no',
        'status',
    ];

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function payrollItems()
    {
        return $this->hasMany(PayrollItem::class);
    }

    protected static function booted()
    {
        static::created(function ($employee) {

            if (!$employee->employee_code) {

                $employee->employee_code =
                    'EMP-' . now()->year . '-' .
                    str_pad($employee->id, 4, '0', STR_PAD_LEFT);

                $employee->save();
            }
        });
    }

    public function recomputeDeductions()
    {
        // dd("recompute");
        $philhealth = round(
            ($this->monthly_salary * 0.05) / 2,
            2
        );

        $this->deductions()
            ->where('name', 'Philhealth')
            ->update([
                'amount' => $philhealth
            ]);
    }

    public function allowances()
    {
        return $this->hasMany(EmployeeAllowance::class);
    }
    public function deductions()
    {
        return $this->hasMany(EmployeeDeduction::class);
    }
}   