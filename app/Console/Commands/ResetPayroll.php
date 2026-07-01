<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Payroll;
use App\Models\PayrollItem;
use App\Models\PayrollItemAllowance;
use App\Models\PayrollItemDeduction;

class ResetPayroll extends Command
{
    protected $signature = 'payroll:reset';

    protected $description = 'Reset all payroll tables';

    public function handle()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        PayrollItemAllowance::truncate();
        PayrollItemDeduction::truncate();
        PayrollItem::truncate();
        Payroll::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->info(
            'Payroll tables reset successfully.'
        );

        return Command::SUCCESS;
    }
}