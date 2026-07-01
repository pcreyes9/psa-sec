<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $fillable = [
        'payroll_code',
        'month',
        'cutoff',
        'date_from',
        'date_to',
        'total_amount',
        'status',
    ];

    public function items()
    {
        return $this->hasMany(
            PayrollItem::class
        );
    }
}
