<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Attendance;
use Carbon\Carbon;

class AttendanceSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | CLEAR OLD ATTENDANCE
        |--------------------------------------------------------------------------
        */

        Attendance::truncate();

        /*
        |--------------------------------------------------------------------------
        | EMPLOYEES
        |--------------------------------------------------------------------------
        */

        $employees = Employee::all();

        /*
        |--------------------------------------------------------------------------
        | CURRENT MONTH
        |--------------------------------------------------------------------------
        */

        $startDate = Carbon::create(
            now()->year,
            now()->month,
            1
        );

        $endDate = $startDate->copy()
            ->endOfMonth();

        /*
        |--------------------------------------------------------------------------
        | LOOP WHOLE MONTH
        |--------------------------------------------------------------------------
        */

        while ($startDate <= $endDate) {

            /*
            |--------------------------------------------------------------------------
            | ONLY MONDAY TO THURSDAY
            |--------------------------------------------------------------------------
            |
            | Monday    = 1
            | Tuesday   = 2
            | Wednesday = 3
            | Thursday  = 4
            |
            */

            if (
                !in_array(
                    $startDate->dayOfWeek,
                    [
                        Carbon::MONDAY,
                        Carbon::TUESDAY,
                        Carbon::WEDNESDAY,
                        Carbon::THURSDAY,
                        Carbon::FRIDAY,
                    ]
                )
            ) {
                $startDate->addDay();

                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | LOOP EMPLOYEES
            |--------------------------------------------------------------------------
            */

            foreach ($employees as $employee) {

                /*
                |--------------------------------------------------------------------------
                | PERFECT ATTENDANCE
                |--------------------------------------------------------------------------
                */

                $timeIn = Carbon::parse(
                    $startDate->toDateString() . ' 09:00:00'
                );

                $timeOut = Carbon::parse(
                    $startDate->toDateString() . ' 17:00:00'
                );

                /*
                |--------------------------------------------------------------------------
                | TOTAL HOURS
                |--------------------------------------------------------------------------
                */

                $totalHours = round(
                    $timeIn->diffInMinutes($timeOut) / 60,
                    2
                );

                /*
                |--------------------------------------------------------------------------
                | OVERTIME
                |--------------------------------------------------------------------------
                |
                | Official work hours = 10
                | OT only if > 1 hour
                |
                */

                $computedOT = max(
                    0,
                    $totalHours - 8
                );

                $overtimeHours = $computedOT > 1
                    ? $computedOT
                    : 0;

                /*
                |--------------------------------------------------------------------------
                | CREATE ATTENDANCE
                |--------------------------------------------------------------------------
                */

                Attendance::create([

                    'employee_id' => $employee->id,

                    'attendance_date' =>
                        $startDate->toDateString(),

                    'time_in' => $timeIn,

                    'time_out' => $timeOut,

                    'total_hours' => $totalHours,

                    'overtime_hours' => $overtimeHours,

                    'status' => 'Present',
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | NEXT DAY
            |--------------------------------------------------------------------------
            */

            $startDate->addDay();
        }
    }
}