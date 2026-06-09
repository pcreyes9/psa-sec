<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Employee;
use App\Models\Attendance;

class GenerateDailyAttendance extends Command
{
    protected $signature = 'attendance:generate';

    protected $description =
        'Generate pending attendance records';

    public function handle()
    {
        Employee::where('status', 'Active')
            ->each(function ($employee) {

                Attendance::firstOrCreate(
                    [
                        'employee_id' => $employee->id,
                        'attendance_date' => today(),
                    ],
                    [
                        'status' => 'Pending',
                    ]
                );

            });

        $this->info(
            'Attendance records generated.'
        );
    }
}