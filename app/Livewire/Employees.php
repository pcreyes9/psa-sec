<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\Volt\Compilers\Mount;

class Employees extends Component
{
    public $employees, $employee_modal;

    public function mount()
    {
        $this->employees = DB::table('employees')->get();
    }
    
    public function render()
    {
        // dd($this->employees);
        return view('livewire.employees');
    }

    public function modalShow($id)
    {
        $this->employee_modal = DB::table('employees')->where('id', $id)->first();
        // dd($this->employee_modal);
        // $this->dispatchBrowserEvent('show-modal', ['employee' => $employee]);
    }
}
