<div class="relative overflow-x-auto shadow-md sm:rounded-lg border border-gray-200">

    <!-- Top Bar -->
    <div class="space-y-6 m-5">

        <!-- PAGE HEADER -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <div>

                <h1 class="text-3xl font-bold text-gray-900">
                    Employees
                </h1>

                <p class="text-gray-500 mt-1">
                    Manage employee information, salaries, allowances, deductions and leave credits.
                </p>

            </div>

            <button
                wire:click="createEmployee"
                data-modal-target="crud-modal"
                data-modal-toggle="crud-modal"
                class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl shadow">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 4v16m8-8H4"/>

                </svg>

                Add Employee

            </button>

        </div>

        <!-- SEARCH CARD -->
        <div class="bg-white rounded-2xl shadow border border-gray-200 p-5">

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

                <div class="relative w-full lg:w-96">

                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">

                        🔍

                    </div>

                    <input
                        type="text"
                        placeholder="Search employee..."
                        class="w-full rounded-xl border-gray-300 pl-11 pr-4 py-3 focus:ring-blue-500 focus:border-blue-500">

                </div>

                <div class="text-sm text-gray-500">

                    Total Employees

                    <span class="font-bold text-gray-800">

                        {{ count($employees) }}

                    </span>

                </div>

            </div>

        </div>

    </div>

    <!-- TABLE -->
    <table class="w-full text-sm text-left text-gray-600">

        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
            <tr>
                <th class="p-4"><input type="checkbox"></th>
                <th class="px-6 py-3">Employee</th>
                <th class="px-6 py-3">Position</th>
                <th class="px-6 py-3">Department</th>
                <th class="px-6 py-3">Salary</th>
                <th class="px-6 py-3">Status</th>
                <th class="px-6 py-3">Action</th>
            </tr>
        </thead>

        <tbody>

            @forelse ($employees as $employee)
                <tr class="bg-white border-b hover:bg-gray-50">

                    <td class="p-4"><input type="checkbox"></td>

                    <!-- EMPLOYEE -->
                    <td class="px-6 py-4 flex items-center gap-3">

                        <img src="https://ui-avatars.com/api/?name={{ $employee->name }}"
                             class="w-10 h-10 rounded-full">

                        <div>
                            <div class="font-semibold text-gray-900">
                                {{ $employee->name }}
                            </div>

                            <div class="text-xs text-gray-500">
                                {{ $employee->email }}
                            </div>

                            <div class="text-xs text-gray-400">
                                {{ $employee->employee_code }}
                            </div>
                        </div>

                    </td>

                    <td class="px-6 py-4">{{ $employee->position }}</td>
                    <td class="px-6 py-4">{{ $employee->department }}</td>

                    <td class="px-6 py-4 font-medium text-green-600">
                        ₱{{ number_format($employee->monthly_salary, 2) }}
                    </td>

                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs rounded-full
                            {{ $employee->status === 'Active'
                                ? 'bg-green-100 text-green-700'
                                : 'bg-red-100 text-red-700' }}">
                            {{ $employee->status }}
                        </span>
                    </td>

                    <!-- ACTION -->
                    <td class="px-6 py-4">

                        <!-- Dropdown Button -->
                        <button id="dropdownButton{{ $employee->id }}"
                                data-dropdown-toggle="dropdown{{ $employee->id }}"
                                class="inline-flex items-center px-3 py-2 text-xs font-medium border rounded-lg hover:bg-gray-100"
                                type="button">

                            Actions

                            <svg class="w-3 h-3 ms-2" viewBox="0 0 10 6" fill="none">
                                <path stroke="currentColor"
                                    stroke-width="2"
                                    d="m1 1 4 4 4-4"/>
                            </svg>

                        </button>

                        <!-- Dropdown Menu -->
                        <div id="dropdown{{ $employee->id }}"
                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">

                            <ul class="py-2 text-sm text-gray-700">

                                <!-- VIEW -->
                                <li>
                                    <button
                                        type="button"
                                        class="block w-full text-left px-4 py-2 hover:bg-gray-100"
                                        data-modal-target="crud-modal"
                                        data-modal-toggle="crud-modal"
                                        wire:click="modalShow({{ $employee->id }})">

                                        View Employee
                                    </button>
                                </li>

                                <li>
                                    <button
                                        type="button"
                                        class="block w-full text-left px-4 py-2 hover:bg-gray-100"
                                        data-modal-target="crud-modal"
                                        data-modal-toggle="crud-modal"
                                        wire:click="modalShow({{ $employee->id }})">

                                        View Attendance
                                    </button>
                                </li>

                                <!-- DELETE -->
                                <li>
                                    <button
                                        type="button"
                                        class="block w-full text-left px-4 py-2 text-red-600 hover:bg-red-50"
                                        wire:click="delete({{ $employee->id }})">

                                        Delete
                                    </button>
                                </li>

                            </ul>

                        </div>

                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-6 text-gray-500">
                        No employees found.
                    </td>
                </tr>
            @endforelse

        </tbody>

    </table>

    <!-- MODAL -->
    <!-- ===================================================== -->
    <!-- EMPLOYEE MODAL -->
    <!-- ===================================================== -->

    <div
        id="crud-modal"
        wire:ignore.self
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm p-6">

        <div class="w-full max-w-7xl bg-white rounded-3xl shadow-2xl overflow-hidden">

            <!-- ===================================================== -->
            <!-- HEADER -->
            <!-- ===================================================== -->

            <div
                class="relative overflow-hidden bg-gradient-to-r from-blue-700 via-blue-600 to-indigo-700">

                <div class="absolute right-0 top-0 h-full w-1/3 opacity-10">

                    <svg
                        viewBox="0 0 500 500"
                        class="h-full w-full fill-white">

                        <circle
                            cx="250"
                            cy="250"
                            r="220" />

                    </svg>

                </div>

                <div class="relative flex items-center justify-between px-8 py-8">

                    <div class="flex items-center gap-6">

                        <!-- Avatar -->

                        <img
                            src="https://ui-avatars.com/api/?name={{ urlencode($name ?: 'Employee') }}&background=ffffff&color=2563eb&size=128"
                            class="w-24 h-24 rounded-full border-4 border-white shadow-lg">

                        <div>

                            <h2
                                class="text-3xl font-bold text-white">

                                @if($isCreating)

                                    New Employee

                                @else

                                    {{ $name }}

                                @endif

                            </h2>

                            <div
                                class="mt-1 text-blue-100">

                                {{ $position ?: 'No Position Assigned' }}

                            </div>

                            <div
                                class="mt-4 flex flex-wrap gap-2">

                                @if($isCreating)

                                    <span class="text-gray-500 italic">

                                        Auto Generated

                                    </span>

                                @else

                                    {{ $employee_modal?->employee_code }}

                                @endif

                                <span

                                    class="rounded-full px-3 py-1 text-xs font-semibold

                                    {{ ($status ?? '') == 'Active'

                                        ? 'bg-green-500 text-white'

                                        : 'bg-red-500 text-white' }}">

                                    {{ $status ?: 'New Employee' }}

                                </span>

                            </div>

                        </div>

                    </div>

                    <button

                        data-modal-hide="crud-modal"

                        class="rounded-xl p-3 text-white transition hover:bg-white/20">

                        ✕

                    </button>

                </div>

            </div>

            <!-- ===================================================== -->
            <!-- BODY -->
            <!-- ===================================================== -->

            <div
                class="max-h-[75vh] overflow-y-auto bg-gray-100 p-8">

                <div
                    class="grid gap-6 xl:grid-cols-2">

                    <!-- ===================================================== -->
                    <!-- PERSONAL INFORMATION -->
                    <!-- ===================================================== -->

                    <div
                        class="rounded-2xl bg-white p-6 shadow-sm">

                        <div
                            class="mb-6 flex items-center gap-4">

                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 text-xl">

                                👤

                            </div>

                            <div>

                                <h3
                                    class="text-xl font-bold text-gray-900">

                                    Personal Information

                                </h3>

                                <p
                                    class="text-sm text-gray-500">

                                    Employee basic details

                                </p>

                            </div>

                        </div>

                        <div
                            class="space-y-5">

                            <!-- NAME -->

                            <div>

                                <label
                                    class="mb-2 block text-xs font-semibold uppercase tracking-wider text-gray-500">

                                    Full Name

                                </label>

                                @if($isEditing)

                                    <input

                                        type="text"

                                        wire:model="name"

                                        class="w-full rounded-xl border-gray-300">

                                @else

                                    <div
                                        class="rounded-xl border bg-gray-50 px-4 py-3 font-medium">

                                        {{ $name }}

                                    </div>

                                @endif

                            </div>

                            <!-- EMAIL -->

                            <div>

                                <label
                                    class="mb-2 block text-xs font-semibold uppercase tracking-wider text-gray-500">

                                    Email Address

                                </label>

                                @if($isEditing)

                                    <input

                                        type="email"

                                        wire:model="email"

                                        class="w-full rounded-xl border-gray-300">

                                @else

                                    <div
                                        class="rounded-xl border bg-gray-50 px-4 py-3">

                                        {{ $email }}

                                    </div>

                                @endif

                            </div>

                            <!-- PHONE -->

                            <div>

                                <label
                                    class="mb-2 block text-xs font-semibold uppercase tracking-wider text-gray-500">

                                    Phone Number

                                </label>

                                @if($isEditing)

                                    <input

                                        type="text"

                                        wire:model="phone_number"

                                        class="w-full rounded-xl border-gray-300">

                                @else

                                    <div
                                        class="rounded-xl border bg-gray-50 px-4 py-3">

                                        {{ $phone_number }}

                                    </div>

                                @endif

                            </div>

                        </div>

                    </div>

                    <!-- ===================================================== -->
                    <!-- EMPLOYMENT DETAILS -->
                    <!-- ===================================================== -->

                    <div
                        class="rounded-2xl bg-white p-6 shadow-sm">

                        <div
                            class="mb-6 flex items-center gap-4">

                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-100 text-xl">

                                💼

                            </div>

                            <div>

                                <h3
                                    class="text-xl font-bold text-gray-900">

                                    Employment Details

                                </h3>

                                <p
                                    class="text-sm text-gray-500">

                                    Employee position and employment information

                                </p>

                            </div>

                        </div>

                        <div
                            class="grid gap-5 md:grid-cols-2">

                            <!-- Employee Code -->

                            <div>

                                <label
                                    class="mb-2 block text-xs font-semibold uppercase tracking-wider text-gray-500">

                                    Employee Code

                                </label>

                                <div
                                    class="rounded-xl border bg-gray-50 px-4 py-3 font-semibold">

                                     @if($isCreating)

                                        <span class="text-gray-500 italic">

                                            Auto Generated

                                        </span>

                                    @else

                                        {{ $employee_modal?->employee_code }}

                                    @endif

                                </div>

                            </div>

                            <!-- Status -->

                            <div>

                                <label
                                    class="mb-2 block text-xs font-semibold uppercase tracking-wider text-gray-500">

                                    Status

                                </label>

                                @if($isEditing)

                                    <select

                                        wire:model="status"

                                        class="w-full rounded-xl border-gray-300">

                                        <option value="Active">

                                            Active

                                        </option>

                                        <option value="Inactive">

                                            Inactive

                                        </option>

                                    </select>

                                @else

                                    <div
                                        class="rounded-xl border bg-gray-50 px-4 py-3">

                                        <span

                                            class="rounded-full px-3 py-1 text-xs font-semibold

                                            {{ $status == 'Active'

                                                ? 'bg-green-100 text-green-700'

                                                : 'bg-red-100 text-red-700' }}">

                                            {{ $status }}

                                        </span>

                                    </div>

                                @endif

                            </div>

                            <!-- Position -->

                            <div>

                                <label
                                    class="mb-2 block text-xs font-semibold uppercase tracking-wider text-gray-500">

                                    Position

                                </label>

                                @if($isEditing)

                                    <input

                                        wire:model="position"

                                        type="text"

                                        class="w-full rounded-xl border-gray-300">

                                @else

                                    <div
                                        class="rounded-xl border bg-gray-50 px-4 py-3">

                                        {{ $position }}

                                    </div>

                                @endif

                            </div>

                            <!-- Department -->

                            <div>

                                <label
                                    class="mb-2 block text-xs font-semibold uppercase tracking-wider text-gray-500">

                                    Department

                                </label>

                                @if($isEditing)

                                    <input

                                        wire:model="department"

                                        type="text"

                                        class="w-full rounded-xl border-gray-300">

                                @else

                                    <div
                                        class="rounded-xl border bg-gray-50 px-4 py-3">

                                        {{ $department }}

                                    </div>

                                @endif

                            </div>

                        </div>

                        <!-- Salary Card -->

                        <div
                            class="mt-8 rounded-2xl bg-gradient-to-r from-green-600 to-emerald-600 p-6 text-white">

                            <div
                                class="text-sm uppercase tracking-widest text-green-100">

                                Monthly Salary

                            </div>

                            @if($isEditing)

                                <input

                                    wire:model="monthly_salary"

                                    type="number"

                                    step="0.01"

                                    class="mt-4 w-full rounded-xl border-white/30 bg-white/20 text-3xl font-bold text-white placeholder-white">

                            @else

                                <div
                                    class="mt-2 text-4xl font-bold">

                                    ₱{{ number_format($monthly_salary,2) }}

                                </div>

                            @endif

                        </div>

                    </div>

                    <!-- ===================================================== -->
                    <!-- GOVERNMENT INFORMATION -->
                    <!-- ===================================================== -->

                    <div
                        class="rounded-2xl bg-white p-6 shadow-sm xl:col-span-2">

                        <div
                            class="mb-6 flex items-center gap-4">

                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-xl bg-orange-100 text-xl">

                                🪪

                            </div>

                            <div>

                                <h3
                                    class="text-xl font-bold">

                                    Government Information

                                </h3>

                                <p
                                    class="text-sm text-gray-500">

                                    Government identification numbers

                                </p>

                            </div>

                        </div>

                        <div
                            class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">

                            <!-- SSS -->

                            <div>

                                <label class="mb-2 block text-xs uppercase text-gray-500">

                                    SSS Number

                                </label>

                                <input

                                    wire:model="sss_no"

                                    @disabled(!$isEditing)

                                    class="w-full rounded-xl border-gray-300"

                                    type="text">

                            </div>

                            <!-- PhilHealth -->

                            <div>

                                <label class="mb-2 block text-xs uppercase text-gray-500">

                                    PhilHealth

                                </label>

                                <input

                                    wire:model="philhealth_no"

                                    @disabled(!$isEditing)

                                    class="w-full rounded-xl border-gray-300"

                                    type="text">

                            </div>

                            <!-- Pag-IBIG -->

                            <div>

                                <label class="mb-2 block text-xs uppercase text-gray-500">

                                    Pag-IBIG

                                </label>

                                <input

                                    wire:model="pagibig_no"

                                    @disabled(!$isEditing)

                                    class="w-full rounded-xl border-gray-300"

                                    type="text">

                            </div>

                            <!-- TIN -->

                            <div>

                                <label class="mb-2 block text-xs uppercase text-gray-500">

                                    TIN

                                </label>

                                <input

                                    wire:model="tin_no"

                                    @disabled(!$isEditing)

                                    class="w-full rounded-xl border-gray-300"

                                    type="text">

                            </div>

                        </div>

                    </div>
                    
                    <!-- ===================================================== -->
                    <!-- PAYROLL CONFIGURATION -->
                    <!-- ===================================================== -->

                    <div class="xl:col-span-2 grid xl:grid-cols-2 gap-6">

                        <!-- ============================================== -->
                        <!-- ALLOWANCES -->
                        <!-- ============================================== -->

                        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

                            <div class="bg-green-600 text-white px-6 py-4 flex items-center justify-between">

                                <div>

                                    <h3 class="text-xl font-bold">

                                        Allowances

                                    </h3>

                                    <p class="text-green-100 text-sm">

                                        Employee recurring allowances

                                    </p>

                                </div>

                                @if($isEditing)

                                    <button

                                        wire:click="addAllowance"

                                        type="button"

                                        class="bg-white text-green-700 px-4 py-2 rounded-xl font-semibold hover:bg-green-50">

                                        + Add

                                    </button>

                                @endif

                            </div>

                            <div class="p-6 space-y-4">

                                @forelse($allowances as $index => $allowance)

                                    <div
                                        class="rounded-xl border border-green-200 p-4 bg-green-50">

                                        <div
                                            class="grid grid-cols-12 gap-4">

                                            <!-- Name -->

                                            <div class="col-span-7">

                                                <label
                                                    class="text-xs uppercase text-gray-500">

                                                    Allowance

                                                </label>

                                                @if($isEditing)

                                                    <input

                                                        wire:model="allowances.{{ $index }}.name"

                                                        class="w-full mt-1 rounded-xl border-gray-300">

                                                @else

                                                    <div class="mt-2 font-medium">

                                                        {{ $allowance['name'] }}

                                                    </div>

                                                @endif

                                            </div>

                                            <!-- Amount -->

                                            <div class="col-span-3">

                                                <label
                                                    class="text-xs uppercase text-gray-500">

                                                    Amount

                                                </label>

                                                @if($isEditing)

                                                    <input

                                                        wire:model="allowances.{{ $index }}.amount"

                                                        type="number"

                                                        step="0.01"

                                                        class="w-full mt-1 rounded-xl border-gray-300">

                                                @else

                                                    <div
                                                        class="mt-2 text-lg font-bold text-green-700">

                                                        ₱{{ number_format($allowance['amount'],2) }}

                                                    </div>

                                                @endif

                                            </div>

                                            <!-- Remove -->

                                            <div
                                                class="col-span-2 flex items-end justify-end">

                                                @if($isEditing)

                                                    <button

                                                        wire:click="removeAllowance({{ $index }})"

                                                        class="rounded-xl bg-red-100 px-3 py-2 text-red-600 hover:bg-red-200">

                                                        ✕

                                                    </button>

                                                @endif

                                            </div>

                                        </div>

                                    </div>

                                @empty

                                    <div class="text-center text-gray-400 py-8">

                                        No Allowances

                                    </div>

                                @endforelse

                            </div>

                        </div>

                        <!-- ============================================== -->
                        <!-- DEDUCTIONS -->
                        <!-- ============================================== -->

                        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

                            <div class="bg-red-600 text-white px-6 py-4 flex items-center justify-between">

                                <div>

                                    <h3 class="text-xl font-bold">

                                        Deductions

                                    </h3>

                                    <p class="text-red-100 text-sm">

                                        Employee recurring deductions

                                    </p>

                                </div>

                                @if($isEditing)

                                    <button

                                        wire:click="addDeduction"

                                        class="bg-white text-red-700 px-4 py-2 rounded-xl font-semibold">

                                        + Add

                                    </button>

                                @endif

                            </div>

                            <div class="p-6 space-y-4">

                                @forelse($deductions as $index => $deduction)

                                    <div
                                        class="rounded-xl border border-red-200 bg-red-50 p-4">

                                        <div
                                            class="grid grid-cols-12 gap-4">

                                            <!-- Name -->

                                            <div class="col-span-5">

                                                <label
                                                    class="text-xs uppercase text-gray-500">

                                                    Deduction

                                                </label>

                                                @if($isEditing)

                                                    <input

                                                        wire:model="deductions.{{ $index }}.name"

                                                        class="w-full mt-1 rounded-xl border-gray-300">

                                                @else

                                                    <div class="mt-2 font-medium">

                                                        {{ $deduction['name'] }}

                                                    </div>

                                                @endif

                                            </div>

                                            <!-- Type -->

                                            <div class="col-span-3">

                                                <label
                                                    class="text-xs uppercase text-gray-500">

                                                    Type

                                                </label>

                                                @if($isEditing)

                                                    <select

                                                        wire:model="deductions.{{ $index }}.type"

                                                        class="w-full mt-1 rounded-xl border-gray-300">

                                                        <option>

                                                            Government

                                                        </option>

                                                        <option>

                                                            Loan

                                                        </option>

                                                        <option>

                                                            Penalty

                                                        </option>

                                                        <option>

                                                            Other

                                                        </option>

                                                    </select>

                                                @else

                                                    <div class="mt-2">

                                                        {{ $deduction['type'] }}

                                                    </div>

                                                @endif

                                            </div>

                                            <!-- Amount -->

                                            <div class="col-span-2">

                                                <label
                                                    class="text-xs uppercase text-gray-500">

                                                    Amount

                                                </label>

                                                @if($isEditing)

                                                    <input

                                                        wire:model="deductions.{{ $index }}.amount"

                                                        type="number"

                                                        step="0.01"

                                                        class="w-full mt-1 rounded-xl border-gray-300">

                                                @else

                                                    <div
                                                        class="mt-2 font-bold text-red-600">

                                                        ₱{{ number_format($deduction['amount'],2) }}

                                                    </div>

                                                @endif

                                            </div>

                                            <!-- Remove -->

                                            <div
                                                class="col-span-2 flex items-end justify-end">

                                                @if($isEditing)

                                                    <button

                                                        wire:click="removeDeduction({{ $index }})"

                                                        class="rounded-xl bg-red-100 px-3 py-2 text-red-600 hover:bg-red-200">

                                                        ✕

                                                    </button>

                                                @endif

                                            </div>

                                        </div>

                                    </div>

                                @empty

                                    <div class="text-center text-gray-400 py-8">

                                        No Deductions

                                    </div>

                                @endforelse

                            </div>

                        </div>

                    </div>

                    <!-- ===================================================== -->
                    <!-- LEAVE CREDITS -->
                    <!-- ===================================================== -->

                    <div class="xl:col-span-2">

                        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

                            <div class="px-6 py-5 border-b bg-gradient-to-r from-cyan-600 to-blue-600 text-white">

                                <h3 class="text-xl font-bold">

                                    Leave Credits

                                </h3>

                                <p class="text-blue-100 text-sm mt-1">

                                    Employee leave balances and usage history

                                </p>

                            </div>

                            <div class="p-6">

                                <div class="grid lg:grid-cols-2 gap-6">

                                    <!-- Vacation Leave -->

                                    <div
                                        class="rounded-2xl border border-green-200 bg-green-50 overflow-hidden">

                                        <div
                                            class="px-5 py-4 border-b border-green-200">

                                            <div
                                                class="flex justify-between items-center">

                                                <div>

                                                    <div
                                                        class="text-lg font-bold text-green-800">

                                                        Vacation Leave

                                                    </div>

                                                    <div
                                                        class="text-sm text-green-600">

                                                        Remaining Balance

                                                    </div>

                                                </div>

                                                <div
                                                    class="text-4xl font-bold text-green-700">

                                                    {{ $availVL }}

                                                </div>

                                            </div>

                                        </div>

                                        <div
                                            class="p-5">

                                            <h4
                                                class="text-xs uppercase tracking-widest text-gray-500 mb-3">

                                                Used Leave Dates

                                            </h4>

                                            @forelse($vacationLeaveDates as $date)

                                                <div
                                                    class="flex justify-between py-2 border-b border-green-100">

                                                    <span>

                                                        {{ \Carbon\Carbon::parse($date)->format('M d, Y') }}

                                                    </span>

                                                    <span
                                                        class="text-gray-500">

                                                        {{ \Carbon\Carbon::parse($date)->format('D') }}

                                                    </span>

                                                </div>

                                            @empty

                                                <div
                                                    class="text-center text-gray-400 py-6">

                                                    No vacation leave used.

                                                </div>

                                            @endforelse

                                        </div>

                                    </div>

                                    <!-- Sick Leave -->

                                    <div
                                        class="rounded-2xl border border-blue-200 bg-blue-50 overflow-hidden">

                                        <div
                                            class="px-5 py-4 border-b border-blue-200">

                                            <div
                                                class="flex justify-between items-center">

                                                <div>

                                                    <div
                                                        class="text-lg font-bold text-blue-800">

                                                        Sick Leave

                                                    </div>

                                                    <div
                                                        class="text-sm text-blue-600">

                                                        Remaining Balance

                                                    </div>

                                                </div>

                                                <div
                                                    class="text-4xl font-bold text-blue-700">

                                                    {{ $availSL }}

                                                </div>

                                            </div>

                                        </div>

                                        <div
                                            class="p-5">

                                            <h4
                                                class="text-xs uppercase tracking-widest text-gray-500 mb-3">

                                                Used Leave Dates

                                            </h4>

                                            @forelse($sickLeaveDates as $date)

                                                <div
                                                    class="flex justify-between py-2 border-b border-blue-100">

                                                    <span>

                                                        {{ \Carbon\Carbon::parse($date)->format('M d, Y') }}

                                                    </span>

                                                    <span
                                                        class="text-gray-500">

                                                        {{ \Carbon\Carbon::parse($date)->format('D') }}

                                                    </span>

                                                </div>

                                            @empty

                                                <div
                                                    class="text-center text-gray-400 py-6">

                                                    No sick leave used.

                                                </div>

                                            @endforelse

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

            <!-- ===================================================== -->
            <!-- FOOTER -->
            <!-- ===================================================== -->

            <div
                class="sticky bottom-0 border-t bg-white px-8 py-5 flex items-center justify-between">

                <div>

                    @if(session()->has('success'))

                        <div
                            class="rounded-xl bg-green-100 px-4 py-2 text-green-700 font-medium">

                            ✅ {{ session('success') }}

                        </div>

                    @endif

                </div>

                <div class="flex gap-3">

                    <button

                        data-modal-hide="crud-modal"

                        class="rounded-xl border border-gray-300 px-6 py-3 hover:bg-gray-100">

                        Close

                    </button>

                    @if(!$isEditing && !$isCreating)

                        <button

                            wire:click="editEmployee"

                            class="rounded-xl bg-blue-600 px-6 py-3 font-medium text-white hover:bg-blue-700">

                            Edit Employee

                        </button>

                    @endif

                    @if($isEditing)

                        <button

                            wire:click="{{ $isCreating ? 'saveEmployee' : 'updateEmployee' }}"

                            class="rounded-xl bg-green-600 px-6 py-3 font-medium text-white hover:bg-green-700">

                            {{ $isCreating ? 'Create Employee' : 'Save Changes' }}

                        </button>

                    @endif

                </div>

            </div>
    </div>
</div>
