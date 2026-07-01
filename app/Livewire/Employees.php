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

    public $isCreating = false;

    public $vacationLeaveDates = [], $sickLeaveDates = [], $vacationLeaves = 0, $sickLeaves = 0, $availVL = 0, $availSL = 0;

    public function mount()
    {
        $this->employees = Employee::latest()->get();
        // dd($this->employees);
    }

    public function render()
    {
        return view('livewire.employees');
    }

    public function createEmployee()
    {
        
        $this->reset([

            'name',
            'email',
            'phone_number',
            'position',
            'department',
            'monthly_salary',
            'status',
            'sss_no',
            'pagibig_no',
            'philhealth_no',
            'tin_no',

        ]);

        $this->employee_modal = null;

        $this->allowances = [];

        $this->deductions = [];

        $this->isEditing = true;

        $this->isCreating = true;
    }

    public function saveEmployee()
    {
        // dd("save");
        $this->validate([

            'name' => 'required',

            'email' => 'required|email|unique:employees,email',

            'phone_number' => 'required',

            'position' => 'required',

            'department' => 'required',

            'monthly_salary' => 'required|numeric',

            'status' => 'required',

            // 'sss_no' => 'required',

            // 'pagibig_no' => 'required',

            // 'philhealth_no' => 'required',

            // 'tin_no' => 'required',

        ]);

        dd("validation");

        $employee = Employee::create([

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
        

        foreach ($this->allowances as $allowance) {

            if (
                empty($allowance['name']) ||
                $allowance['amount'] <= 0
            ) {
                continue;
            }

            $employee
                ->allowances()
                ->create([

                    'name' => $allowance['name'],

                    'amount' => $allowance['amount'],

                ]);
        }

        foreach ($this->deductions as $deduction) {

            if (
                empty($deduction['name']) ||
                $deduction['amount'] <= 0
            ) {
                continue;
            }

            $employee
                ->deductions()
                ->create([

                    'name' => $deduction['name'],

                    'type' => $deduction['type'],

                    'amount' => $deduction['amount'],

                    'is_active' => 1,

                ]);
        }

        $employee->recomputeDeductions();

        $this->employees =
            Employee::latest()->get();

        session()->flash(
            'success',
            'Employee created successfully.'
        );

        $this->isEditing = false;

        $this->isCreating = false;
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

        $this->vacationLeaves = Attendance::where(
                'employee_id',
                $employee->id
            )
            ->whereIn('status', [
                'Vacation Leave',
                'Half Day - VL'
            ])
            ->orderBy('attendance_date')
            ->get();

        $this->availVL =
            Setting::where(
                'key',
                'vacation_leaves'
            )->value('value')
            -
            $this->vacationLeaves->sum(function ($leave) {

                return $leave->status === 'Half Day - VL'
                    ? 0.5
                    : 1;

            });

        $this->vacationLeaveDates = $this->vacationLeaves
            ->pluck('attendance_date')
            ->toArray();

        $this->sickLeaves = Attendance::where(
            'employee_id',
            $employee->id
        )
        ->whereIn('status', [
            'Sick Leave',
            'Half Day - SL'
        ])
        ->orderBy('attendance_date')
        ->get();

    $this->availSL =
        Setting::where(
            'key',
            'sick_leaves'
        )->value('value')
        -
        $this->sickLeaves->sum(function ($leave) {

            return $leave->status === 'Half Day - SL'
                ? 0.5
                : 1;

        });

        $this->sickLeaveDates = $this->sickLeaves
            ->pluck('attendance_date')
            ->toArray();



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