<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayrollItemDeduction extends Model
{
    protected $fillable = [

        'payroll_item_id',

        'deduction_name',

        'deduction_type',

        'amount',
    ];

    public function payrollItem()
    {
        return $this->belongsTo(
            PayrollItem::class
        );
    }
}
