<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeDeduction extends Model
{
    protected $fillable = [

        'employee_id',
        'name',
        'amount',
        'type',
        'is_active',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}