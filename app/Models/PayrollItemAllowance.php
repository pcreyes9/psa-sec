<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayrollItemAllowance extends Model
{
    protected $fillable = [

        'payroll_item_id',

        'allowance_name',

        'amount',
    ];

    public function payrollItem()
    {
        return $this->belongsTo(
            PayrollItem::class
        );
    }
}
