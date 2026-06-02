<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TaxBracket;

class TaxBracketSeeder extends Seeder
{
    public function run(): void
    {
        TaxBracket::truncate();

        TaxBracket::insert([

            [
                'min_amount' => 0,
                'max_amount' => 10417.00,
                'base_tax' => 0,
                'percentage' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'min_amount' => 10417.00,
                'max_amount' => 16666.00,
                'base_tax' => 0,
                'percentage' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'min_amount' => 16667.00,
                'max_amount' => 33332.00,
                'base_tax' => 937.50,
                'percentage' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'min_amount' => 33333.00,
                'max_amount' => 83333.00,
                'base_tax' => 4270.70,
                'percentage' => 25,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'min_amount' => 83333.01,
                'max_amount' => 166667.00,
                'base_tax' => 17541.80,
                'percentage' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'min_amount' => 166667.01,
                'max_amount' => null,
                'base_tax' => 183541.80,
                'percentage' => 35,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}