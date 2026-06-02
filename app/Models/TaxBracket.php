<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxBracket extends Model
{
    protected $fillable = [
        'min_amount',
        'max_amount',
        'base_tax',
        'percentage',
    ];

    protected $casts = [
        'min_amount' => 'decimal:2',
        'max_amount' => 'decimal:2',
        'base_tax' => 'decimal:2',
        'percentage' => 'decimal:2',
    ];

    public function computeTax(float $income): float
    {   
        $excess = $income - $this->min_amount;

        return round(
            $this->base_tax +
            ($excess * ($this->percentage / 100)),
            2
        );
    }
}
