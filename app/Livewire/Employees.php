<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\Setting;


class Employees extends Component
    {
    public $name, $email, $phone_number, $position, $department,
        $monthly_salary, $status, $sss_no, $pagibig_no,
        $philhealth_no, $tin_no;

    public $employees = [];
    public $employee_modal = null;

    public $allowances = [];
    public $deductions = [];    

    public $isEditing = false;

    public $vacationLeaves = [], $sickLeaves = [], $availVL = 0, $availSL = 0;

    public function mount()
    {
        $this->employees = Employee::latest()->get();
    }

    public function render()
    {
        return view('livewire.employees');
    }

    public function editEmployee()
    {
        $this->isEditing = true;
    }

    public function modalShow($id)
    {
        // dd($id);
        $this->isEditing = false;
        $employee = Employee::findOrFail($id);

        $this->vacationLeaves = Attendance::where('employee_id', $employee->id)
            ->where('status', 'Vacation Leave')
            ->orderBy('attendance_date')
            ->pluck('attendance_date')
            ->toArray();

        $this->sickLeaves = Attendance::where('employee_id',$employee->id)
            ->where('status', 'Sick Leave')
            ->orderBy('attendance_date')
            ->pluck('attendance_date')
            ->toArray();

        $this->availVL = Setting::where('key', 'vacation_leaves')->pluck('value')->first() - count($this->vacationLeaves);
        $this->availSL = Setting::where('key', 'sick_leaves')->pluck('value')->first() - count($this->sickLeaves);

        // dd($this->availVL);

        // dd($this->availSL);

        $this->employee_modal = $employee;

        $this->name = $employee->name;
        $this->email = $employee->email;
        $this->phone_number = $employee->phone_number;
        $this->position = $employee->position;
        $this->department = $employee->department;
        $this->monthly_salary = $employee->monthly_salary;
        $this->status = $employee->status;
        $this->sss_no = $employee->sss_no;
        $this->pagibig_no = $employee->pagibig_no;
        $this->philhealth_no = $employee->philhealth_no;
        $this->tin_no = $employee->tin_no;

        $this->allowances = $employee
            ->allowances
            ->toArray();

        $this->deductions = $employee
            ->deductions()
            ->get()
            ->toArray();

    }

    public function updateEmployee()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
            'position' => 'required',
            'department' => 'required',
            'monthly_salary' => 'required|numeric',
            'status' => 'required',
            'sss_no' => 'required',
            'pagibig_no' => 'required',
            'philhealth_no' => 'required',
            'tin_no' => 'required',
        ]);

        $this->employee_modal->update([

            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'position' => $this->position,
            'department' => $this->department,
            'monthly_salary' => $this->monthly_salary,
            'status' => $this->status,
            'sss_no' => $this->sss_no,
            'pagibig_no' => $this->pagibig_no,
            'philhealth_no' => $this->philhealth_no,
            'tin_no' => $this->tin_no,
        ]);

        $this->employee_modal
            ->allowances()
            ->delete();

        foreach ($this->allowances as $allowance) {

            if (
                empty($allowance['name']) ||
                $allowance['amount'] <= 0
            ) {
                continue;
            }

            $this->employee_modal
                ->allowances()
                ->create([

                    'name' => $allowance['name'],
                    'amount' => $allowance['amount'],
                ]);
        }

        $this->employee_modal
            ->deductions()
            ->delete();

        foreach ($this->deductions as $deduction) {

            if (
                empty($deduction['name']) ||
                $deduction['amount'] <= 0
            ) {
                continue;
            }

            $this->employee_modal
                ->deductions()
                ->create([

                    'name' => $deduction['name'],

                    'type' => $deduction['type'],

                    'amount' => $deduction['amount'],

                    'is_active' => 1,
                ]);
        }

        $this->employee_modal->recomputeDeductions();

        // Refresh employee list
        $this->employees = Employee::orderBy('name')->get();

        session()->flash(
            'success',
            'Employee updated successfully.'
        );
        $this->isEditing = false;
    }

    public function addAllowance()
    {
        $this->allowances[] = [
            'name' => '',
            'amount' => 0,
        ];
    }

    public function removeAllowance($index)
    {
        unset($this->allowances[$index]);

        $this->allowances =
            array_values($this->allowances);
    }

    public function addDeduction()
    {
        $this->deductions[] = [

            'name' => '',

            'type' => 'Other',

            'amount' => 0,
        ];
    }

    public function removeDeduction($index)
    {
        unset($this->deductions[$index]);

        $this->deductions =
            array_values($this->deductions);
    }

    public function delete($id)
    {
        Employee::findOrFail($id)->delete();

        // refresh list
        $this->employees = Employee::latest()->get();
    }
}