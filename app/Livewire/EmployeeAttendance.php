<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee;
use App\Models\Attendance;
use Carbon\Carbon;

class EmployeeAttendance extends Component
{
    public $employees = [];

    public $selectedEmployee = null;
    public $attendance = [];

    public $month;
    public $cutoff = '1';
    public $status = '';

    public $cutoffTotalHours = 0;

    public function mount()
    {
        $this->employees = Employee::orderBy('name')->get();

        $this->month = now()->format('Y-m');
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

    public function render()
    {
        return view('livewire.employee-attendance');
    }
}