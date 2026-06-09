<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Employee;
use App\Models\Attendance as AttendanceModel;
use App\Models\Setting;

class Attendance extends Component
{
    public $employees = [];
    public $selectedEmployee = '';

    public $canTimeIn = false;
    public $canTimeOut = false;
    public $settings;
    public function mount()
    {
        $this->generateTodayAttendance();
        $this->settings = Setting::pluck(
            'value',
            'key'
        )->toArray();
        $this->employees = Employee::orderBy('employee_code')->get();
    }

    public function timeIn()
    {
        if (!$this->selectedEmployee) {
            return;
        }

        $today = now()->toDateString();

        $attendance = AttendanceModel::firstOrCreate(
            [
                'employee_id' => $this->selectedEmployee,
                'attendance_date' => $today,
            ]
        );

        if (!$attendance->time_in) {

            $attendance->update([
                'time_in' => now(),
                'status' => 'Present',
            ]);
        }

        $employee = Employee::find($this->selectedEmployee);

        session()->flash(
            'success',
            "Time In recorded successfully for {$employee->name}. Have a great day!"
        );
    }

    public function timeOut()
    {
        if (!$this->selectedEmployee) {
            return;
        }

        $attendance = AttendanceModel::where(
            'employee_id',
            $this->selectedEmployee
        )
        ->whereDate(
            'attendance_date',
            today()
        )
        ->first();

        if (!$attendance || !$attendance->time_in) {
            return;
        }

        $timeIn = Carbon::parse(
            $attendance->time_in
        );

        $timeOut = now();

        $officialTimeIn = Carbon::parse(
            $timeIn->format('Y-m-d') . ' ' .
            $this->settings['official_time_in']
        );

        $graceTime = Carbon::parse(
            $timeIn->format('Y-m-d') . ' ' .
            $this->settings['grace_period_time']
        );

        $adjustedTimeIn = $timeIn->copy();

<<<<<<< HEAD
=======
        // Example:
        // Official = 8:00 AM
        // Grace    = 8:15 AM
        // Actual   = 8:13 AM
        // Payroll treats as 8:00 AM

>>>>>>> adea58223f25f520a9bee1d2707be305a36c330a
        if (
            $timeIn->greaterThanOrEqualTo($officialTimeIn) &&
            $timeIn->lessThanOrEqualTo($graceTime)
        ) {
            $adjustedTimeIn->startOfHour();
        }

        // Total rendered hours
        $totalHours = round(
            $adjustedTimeIn->diffInMinutes($timeOut) / 60,
            2
        );

        $workingHours = (float) (
            Setting::where(
                'key',
                'working_hours_per_day'
            )->value('value') ?? 8
        );

        $computedOT = max(
            0,
            $totalHours - $workingHours
        );

        // Ignore OT <= 1 hour
        $overtimeHours = $computedOT > 1
            ? round($computedOT, 2)
            : 0;

        $attendance->update([
            'time_out' => $timeOut,
            'total_hours' => $totalHours,
            'overtime_hours' => $overtimeHours,
        ]);

        $employee = Employee::find($this->selectedEmployee);
        session()->flash(
            'success',
            "Time Out recorded successfully for {$employee->name}. Take care!"
        );
    }

    public function getTodayAttendanceProperty()
    {
        return AttendanceModel::with('employee')
            ->whereDate(
                'attendance_date',
                today()
            )
            ->latest()
            ->get();
    }

    public function generateTodayAttendance()
    {
        Employee::where('status', 'Active')
            ->each(function ($employee) {

                AttendanceModel::firstOrCreate(
                    [
                        'employee_id' => $employee->id,
                        'attendance_date' => today(),
                    ],
                    [
                        'status' => 'Pending',
                    ]
                );

            });
    }

    public function render()
    {
        $this->canTimeIn = ! AttendanceModel::where(
            'employee_id',
            $this->selectedEmployee
            )
            ->whereDate(
                'attendance_date',
                today()
            )
            ->whereNotNull('time_in')
            ->exists();
        
        $this->canTimeOut = AttendanceModel::where(
            'employee_id',
            $this->selectedEmployee
        )
        ->whereDate(
            'attendance_date',
            today()
        )
        ->whereNotNull('time_in')
        ->whereNull('time_out')
        ->exists();

        return view(
            'livewire.attendance'
        );
    }
}