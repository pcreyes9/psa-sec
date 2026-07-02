<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee;
use App\Models\Attendance;
use Carbon\Carbon;
use App\Models\Setting;
use Symfony\Component\HttpFoundation\StreamedResponse;

class EmployeeAttendance extends Component
{
    public $employees = [];

    public $selectedEmployee = null;
    public $attendance = [];

    public $month;
    public $cutoff = '1';
    public $status = '';

    public $cutoffTotalHours = 0;

    // EDIT ATTENDANCE
    public $showEditModal = false;

    public $attendanceId;

    public $editDate;
    public $editTimeIn;
    public $editTimeOut;
    public $editStatus;
    public $editRemarks;

    public $settings = [];

    public function mount()
{
    $this->employees = Employee::where('status', 'Active')->orderBy('id')->get();

    $this->month = now()->format('Y-m');

    $this->settings = Setting::pluck(
        'value',
        'key'
    )->toArray();
}
    public function selectEmployee($id)
    {
        $this->selectedEmployee = Employee::find($id);
        $this->loadAttendance();
    }

    public function updated($property)
    {
        if ($this->selectedEmployee) {
            $this->loadAttendance();
        }
    }

    public function loadAttendance()
    {
        if (!$this->selectedEmployee) {
            return;
        }

        [$year, $month] = explode('-', $this->month);

        if ($this->cutoff == '1') {

            $start = Carbon::create($year, $month, 1)
                ->startOfDay();

            $end = Carbon::create($year, $month, 15)
                ->endOfDay();

        } else {

            $start = Carbon::create($year, $month, 16)
                ->startOfDay();

            $end = Carbon::create($year, $month)
                ->endOfMonth()
                ->endOfDay();
        }

        $query = Attendance::where('employee_id', $this->selectedEmployee->id)
            ->whereBetween('attendance_date', [
                $start->toDateString(),
                $end->toDateString()
            ]);

        if ($this->status) {
            $query->where('status', $this->status);
        }

        $this->attendance = $query
            ->orderBy('attendance_date', 'desc')
            ->get();
            
        $this->cutoffTotalHours = $this->attendance->sum('total_hours');
    }

    public function editAttendance($id)
    {
        $attendance = Attendance::findOrFail($id);

        $this->attendanceId = $attendance->id;

        $this->editDate = Carbon::parse(
            $attendance->attendance_date
        )->format('Y-m-d');

        $this->editTimeIn = $attendance->time_in
            ? Carbon::parse(
                $attendance->time_in
            )->format('H:i')
            : null;

        $this->editTimeOut = $attendance->time_out
            ? Carbon::parse(
                $attendance->time_out
            )->format('H:i')
            : null;

        $this->editStatus = $attendance->status;

        $this->editRemarks = $attendance->remarks ?? '';

        $this->showEditModal = true;
    }

    public function saveAttendance()
    {
        $attendance = Attendance::findOrFail(
            $this->attendanceId
        );

        $timeIn = null;
        $timeOut = null;

        $totalHours = 0;
        $overtimeHours = 0;

        if ($this->editTimeIn) {
            $this->editStatus = 'Present';

            $timeIn = Carbon::parse(
                $this->editDate . ' ' . $this->editTimeIn
            );
        }

        if ($this->editTimeOut) {

            $timeOut = Carbon::parse(
                $this->editDate . ' ' . $this->editTimeOut
            );

            // Overnight shift
            if (
                $timeIn &&
                $timeOut->lt($timeIn)
            ) {
                $timeOut->addDay();
            }
        }

        if ($timeIn && $timeOut) {
            

            $adjustedTimeIn = $timeIn->copy();

            $graceTime = Carbon::parse(
                $timeIn->format('Y-m-d') . ' ' .
                $this->settings['grace_period_time']
            );

            // Within grace period:
            // 8:13 -> 8:00
            // 8:10 -> 8:00
            if ($timeIn->lessThanOrEqualTo($graceTime)) {

                $adjustedTimeIn->startOfHour();
            }

            // Use adjusted time for ALL payroll computations

            $totalHours = round(
                $adjustedTimeIn->diffInMinutes($timeOut) / 60,
                2
            );

            $workingHours = (float)
                $this->settings['working_hours_per_day'];

            $computedOT = max(
                0,
                $totalHours - $workingHours
            );

            // Ignore OT <= 1 hour

            $overtimeHours = $computedOT > 1
                ? round($computedOT, 2)
                : 0;
        }

        // dd($overtimeHours);
        $attendance->update([

            'attendance_date' => $this->editDate,
            'time_in' => $timeIn,
            'time_out' => $timeOut,
            'total_hours' => $totalHours,
            'overtime_hours' => $overtimeHours,
            'status' => $this->editStatus,
            'remarks' => $this->editRemarks,

        ]);

        $this->showEditModal = false;

        $this->loadAttendance();

        session()->flash(
            'success',
            'Attendance updated successfully.'
        );
    }

    public function exportAttendanceSql()
    {
        $attendances = Attendance::orderBy('id')->get();

        $sql = "-- PSA Explorer Attendance Backup\n";
        $sql .= "-- Generated: " . now() . "\n\n";

        $sql .= "SET FOREIGN_KEY_CHECKS=0;\n";
        $sql .= "TRUNCATE TABLE `attendances`;\n";
        $sql .= "SET FOREIGN_KEY_CHECKS=1;\n\n";

        foreach ($attendances as $attendance) {

            $sql .= sprintf(

                "INSERT INTO `attendances`
    (`id`,`employee_id`,`attendance_date`,`time_in`,`time_out`,`total_hours`,`overtime_hours`,`status`,`remarks`,`created_at`,`updated_at`)
    VALUES
    (%d,%d,%s,%s,%s,%s,%s,%s,%s,%s,%s);\n",

                $attendance->id,

                $attendance->employee_id,

                $attendance->attendance_date
                    ? "'" . $attendance->attendance_date . "'"
                    : "NULL",

                $attendance->time_in
                    ? "'" . $attendance->time_in . "'"
                    : "NULL",

                $attendance->time_out
                    ? "'" . $attendance->time_out . "'"
                    : "NULL",

                $attendance->total_hours,

                $attendance->overtime_hours,

                $attendance->status
                    ? "'" . addslashes($attendance->status) . "'"
                    : "NULL",

                $attendance->remarks !== null
                    ? "'" . addslashes($attendance->remarks) . "'"
                    : "NULL",

                $attendance->created_at
                    ? "'" . $attendance->created_at . "'"
                    : "NULL",

                $attendance->updated_at
                    ? "'" . $attendance->updated_at . "'"
                    : "NULL"

            );

            $sql .= "\n";
        }

        $backupPath = base_path();

        if (!is_dir($backupPath)) {
            mkdir($backupPath, 0777, true);
        }

        $filename = 'Attendance-' . now()->format('Y-m-d') . '.sql';

        file_put_contents(
            base_path($filename),
            $sql
        );

        session()->flash(
            'success',
            "Attendance backup saved successfully to {$filename}"
        );
    }

    public function render()
    {
        return view('livewire.employee-attendance');
    }
}