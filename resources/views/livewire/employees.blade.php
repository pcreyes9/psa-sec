<div class="relative overflow-x-auto shadow-md sm:rounded-lg border border-gray-200">

    <!-- Top Bar -->
    <div class="flex items-center justify-between flex-wrap md:flex-row p-4 bg-white gap-4">
        <div class="relative">
            <input type="text"
                   class="block p-2 ps-10 text-sm border border-gray-300 rounded-lg w-80 bg-gray-50"
                   placeholder="Search employees...">

            <div class="absolute inset-y-0 left-0 flex items-center ps-3">
                🔍
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
    <div id="crud-modal"
        wire:ignore.self
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">

        <div class="bg-white w-full max-w-5xl rounded-2xl shadow-2xl overflow-hidden">

            <!-- HEADER -->
            <div class="relative bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-5 text-white">

                <div class="flex justify-between items-start">

                    <div class="flex items-center gap-4">

                        <!-- AVATAR -->
                        <img
                            src="https://ui-avatars.com/api/?name={{ urlencode($name ?? 'Employee') }}&background=ffffff&color=2563eb"
                            class="w-16 h-16 rounded-full border-4 border-white shadow">

                        <div>

                            <h2 class="text-2xl font-bold">
                                {{ $name ?? 'Employee Details' }}
                            </h2>

                            <p class="text-blue-100 text-sm">
                                {{ $position ?? '-' }}
                            </p>

                            <div class="mt-2">

                                <span class="px-3 py-1 text-xs rounded-full font-medium

                                    {{ ($status ?? '') === 'Active'
                                        ? 'bg-green-100 text-green-700'
                                        : 'bg-red-100 text-red-700' }}">

                                    {{ $status ?? '-' }}

                                </span>

                            </div>

                        </div>

                    </div>

                    <!-- CLOSE -->
                    <button
                        data-modal-hide="crud-modal"
                        class="text-white hover:bg-white/20 rounded-lg p-2 transition">

                        ✕

                    </button>

                </div>

            </div>

            <!-- BODY -->
            <div class="p-6 space-y-6 max-h-[75vh] overflow-y-auto">

                <!-- PERSONAL & EMPLOYMENT -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                    <!-- PERSONAL -->
                    <div class="bg-gray-50 border border-gray-200 rounded-2xl p-5">

                        <h3 class="text-lg font-bold text-gray-800 mb-5">
                            Personal Information
                        </h3>

                        <div class="space-y-4">

                            <!-- NAME -->
                            <div>

                                <label class="text-xs uppercase tracking-wide text-gray-500">
                                    Full Name
                                </label>

                                @if($isEditing)

                                    <input
                                        type="text"
                                        wire:model="name"
                                        class="w-full mt-1 border border-gray-300 rounded-xl p-3">

                                @else

                                    <div class="mt-1 text-gray-800 font-medium">
                                        {{ $name }}
                                    </div>

                                @endif

                            </div>

                            <!-- EMAIL -->
                            <div>

                                <label class="text-xs uppercase tracking-wide text-gray-500">
                                    Email Address
                                </label>

                                @if($isEditing)

                                    <input
                                        type="email"
                                        wire:model="email"
                                        class="w-full mt-1 border border-gray-300 rounded-xl p-3">

                                @else

                                    <div class="mt-1 text-gray-800 font-medium">
                                        {{ $email }}
                                    </div>

                                @endif

                            </div>

                            <!-- PHONE -->
                            <div>

                                <label class="text-xs uppercase tracking-wide text-gray-500">
                                    Phone Number
                                </label>

                                @if($isEditing)

                                    <input
                                        type="text"
                                        wire:model="phone_number"
                                        class="w-full mt-1 border border-gray-300 rounded-xl p-3">

                                @else

                                    <div class="mt-1 text-gray-800 font-medium">
                                        {{ $phone_number }}
                                    </div>

                                @endif

                            </div>

                        </div>

                    </div>

                    <!-- EMPLOYMENT -->
                    <div class="bg-gray-50 border border-gray-200 rounded-2xl p-5">

                        <h3 class="text-lg font-bold text-gray-800 mb-5">
                            Employment Details
                        </h3>

                        <div class="space-y-4">

                            <!-- EMPLOYEE CODE -->
                            <div>

                                <label class="text-xs uppercase tracking-wide text-gray-500">
                                    Employee Code
                                </label>

                                <div class="mt-1 text-gray-800 font-medium">
                                    {{ $employee_modal->employee_code ?? '-' }}
                                </div>

                            </div>

                            <!-- POSITION -->
                            <div>

                                <label class="text-xs uppercase tracking-wide text-gray-500">
                                    Position
                                </label>

                                @if($isEditing)

                                    <input
                                        type="text"
                                        wire:model="position"
                                        class="w-full mt-1 border border-gray-300 rounded-xl p-3">

                                @else

                                    <div class="mt-1 text-gray-800 font-medium">
                                        {{ $position }}
                                    </div>

                                @endif

                            </div>

                            <!-- DEPARTMENT -->
                            <div>

                                <label class="text-xs uppercase tracking-wide text-gray-500">
                                    Department
                                </label>

                                @if($isEditing)

                                    <input
                                        type="text"
                                        wire:model="department"
                                        class="w-full mt-1 border border-gray-300 rounded-xl p-3">

                                @else

                                    <div class="mt-1 text-gray-800 font-medium">
                                        {{ $department }}
                                    </div>

                                @endif

                            </div>

                            <!-- SALARY -->
                            <div>

                                <label class="text-xs uppercase tracking-wide text-gray-500">
                                    Monthly Salary
                                </label>

                                @if($isEditing)

                                    <input
                                        type="number"
                                        step="0.01"
                                        wire:model="monthly_salary"
                                        class="w-full mt-1 border border-gray-300 rounded-xl p-3">

                                @else

                                    <div class="mt-1 text-green-600 font-bold text-lg">
                                        ₱{{ number_format($monthly_salary ?? 0, 2) }}
                                    </div>

                                @endif

                            </div>

                            <!-- STATUS -->
                            <div>

                                <label class="text-xs uppercase tracking-wide text-gray-500">
                                    Status
                                </label>

                                @if($isEditing)

                                    <select
                                        wire:model="status"
                                        class="w-full mt-1 border border-gray-300 rounded-xl p-3">

                                        <option value="Active">
                                            Active
                                        </option>

                                        <option value="Inactive">
                                            Inactive
                                        </option>

                                    </select>

                                @else

                                    <div class="mt-1">
                                        <span class="px-3 py-1 rounded-full text-xs font-medium

                                            {{ $status === 'Active'
                                                ? 'bg-green-100 text-green-700'
                                                : 'bg-red-100 text-red-700' }}">

                                            {{ $status }}

                                        </span>
                                    </div>

                                @endif

                            </div>

                        </div>

                    </div>
                    
                    <!-- ALLOWANCES -->
                    <div class="bg-gray-50 border border-gray-200 rounded-2xl p-5">

                        <div class="flex items-center justify-between mb-5">

                            <h3 class="text-lg font-bold text-gray-800">
                                Allowances
                            </h3>

                            @if($isEditing)

                                <button
                                    wire:click="addAllowance"
                                    type="button"
                                    class="px-3 py-2 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded-xl">

                                    + Add Allowance

                                </button>

                            @endif

                        </div>

                        <!-- ALLOWANCES LIST -->
                        <div class="space-y-4">

                            @forelse($allowances as $index => $allowance)

                                <div class="bg-white border border-gray-200 rounded-xl p-4">

                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                                        <!-- NAME -->
                                        <div>

                                            <label class="text-xs uppercase tracking-wide text-gray-500">
                                                Allowance Name
                                            </label>

                                            @if($isEditing)

                                                <input
                                                    type="text"
                                                    wire:model="allowances.{{ $index }}.name"
                                                    class="w-full mt-1 border border-gray-300 rounded-xl p-3">

                                            @else

                                                <div class="mt-1 font-medium text-gray-800">
                                                    {{ $allowance['name'] }}
                                                </div>

                                            @endif

                                        </div>

                                        <!-- AMOUNT -->
                                        <div>

                                            <label class="text-xs uppercase tracking-wide text-gray-500">
                                                Amount
                                            </label>

                                            @if($isEditing)

                                                <input
                                                    type="number"
                                                    step="0.01"
                                                    wire:model="allowances.{{ $index }}.amount"
                                                    class="w-full mt-1 border border-gray-300 rounded-xl p-3">

                                            @else

                                                <div class="mt-1 font-bold text-green-600">
                                                    ₱{{ number_format($allowance['amount'], 2) }}
                                                </div>

                                            @endif

                                        </div>

                                        <!-- ACTION -->
                                        <div class="flex items-end justify-end">

                                            @if($isEditing)

                                                <button
                                                    wire:click="removeAllowance({{ $index }})"
                                                    type="button"
                                                    class="px-3 py-2 bg-red-100 hover:bg-red-200 text-red-600 rounded-xl text-sm">

                                                    Remove

                                                </button>

                                            @endif

                                        </div>

                                    </div>

                                </div>

                            @empty

                                <div class="text-sm text-gray-500 text-center py-6">

                                    No allowances found.

                                </div>

                            @endforelse

                        </div>

                    </div>

                    <!-- DEDUCTIONS -->
                    <div class="bg-gray-50 border border-gray-200 rounded-2xl p-5">

                        <div class="flex items-center justify-between mb-5">

                            <h3 class="text-lg font-bold text-gray-800">
                                Deductions
                            </h3>

                            @if($isEditing)

                                <button
                                    wire:click="addDeduction"
                                    type="button"
                                    class="px-3 py-2 text-sm bg-red-600 hover:bg-red-700 text-white rounded-xl">

                                    + Add Deduction

                                </button>

                            @endif

                        </div>

                        <!-- DEDUCTION LIST -->
                        <div class="space-y-4">

                            @forelse($deductions as $index => $deduction)

                                <div class="bg-white border border-gray-200 rounded-xl p-4">

                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                                        <!-- NAME -->
                                        <div>

                                            <label class="text-xs uppercase tracking-wide text-gray-500">
                                                Deduction Name
                                            </label>

                                            @if($isEditing)

                                                <input
                                                    type="text"
                                                    wire:model="deductions.{{ $index }}.name"
                                                    class="w-full mt-1 border border-gray-300 rounded-xl p-3">

                                            @else

                                                <div class="mt-1 font-medium text-gray-800">
                                                    {{ $deduction['name'] }}
                                                </div>

                                            @endif

                                        </div>

                                        <!-- TYPE -->
                                        <div>

                                            <label class="text-xs uppercase tracking-wide text-gray-500">
                                                Type
                                            </label>

                                            @if($isEditing)

                                                <select
                                                    wire:model="deductions.{{ $index }}.type"
                                                    class="w-full mt-1 border border-gray-300 rounded-xl p-3">

                                                    <option value="Government">
                                                        Government
                                                    </option>

                                                    <option value="Loan">
                                                        Loan
                                                    </option>

                                                    <option value="Penalty">
                                                        Penalty
                                                    </option>

                                                    <option value="Other">
                                                        Other
                                                    </option>

                                                </select>

                                            @else

                                                <div class="mt-1 text-gray-700">
                                                    {{ $deduction['type'] }}
                                                </div>

                                            @endif

                                        </div>

                                        <!-- AMOUNT -->
                                        <div>

                                            <label class="text-xs uppercase tracking-wide text-gray-500">
                                                Amount
                                            </label>

                                            @if($isEditing)

                                                <input
                                                    type="number"
                                                    step="0.01"
                                                    wire:model="deductions.{{ $index }}.amount"
                                                    class="w-full mt-1 border border-gray-300 rounded-xl p-3">

                                            @else

                                                <div class="mt-1 font-bold text-red-500">
                                                    ₱{{ number_format($deduction['amount'], 2) }}
                                                </div>

                                            @endif

                                        </div>

                                        <!-- REMOVE -->
                                        <div class="flex items-end justify-end">

                                            @if($isEditing)

                                                <button
                                                    wire:click="removeDeduction({{ $index }})"
                                                    type="button"
                                                    class="px-3 py-2 bg-red-100 hover:bg-red-200 text-red-600 rounded-xl text-sm">

                                                    Remove

                                                </button>

                                            @endif

                                        </div>

                                    </div>

                                </div>

                            @empty

                                <div class="text-sm text-gray-500 text-center py-6">

                                    No deductions found.

                                </div>

                            @endforelse

                        </div>

                    </div>

                     <!-- LEAVES -->
                    <div class="bg-gray-50 border border-gray-200 rounded-2xl p-5">

                        <h3 class="text-lg font-bold text-gray-800 mb-5">
                            Leave Credits
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            <!-- VACATION LEAVE -->
                            <div class="bg-white border rounded-xl p-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="text-sm font-semibold text-gray-800">
                                            Vacation Leave
                                        </div>
                                    </div>

                                    <div class="text-right">
                                        <div class="text-2xl font-bold text-green-600">
                                            {{ $availVL }}
                                        </div>

                                        <div class="text-xs text-gray-500">
                                            Available
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 border-t pt-3">
                                    <div class="text-xs uppercase text-gray-500 mb-2">
                                        Used Leave Dates
                                    </div>

                                    @forelse($vacationLeaveDates as $date)
                                        <div class="flex justify-between py-1">
                                            <span class="text-sm text-gray-700">
                                                {{ \Carbon\Carbon::parse($date)->format('M d, Y - D') }}
                                            </span>
                                        </div>
                                    @empty
                                        <div class="text-sm text-gray-400">
                                            No vacation leaves used.
                                        </div>
                                    @endforelse
                                </div>
                            </div>

                            <!-- SICK LEAVE -->
                            <div class="bg-white border rounded-xl p-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="text-sm font-semibold text-gray-800">
                                            Sick Leave
                                        </div>
                                    </div>

                                    <div class="text-right">
                                        <div class="text-2xl font-bold text-blue-600">
                                            {{ $availSL }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            Available
                                        </div>
                                    </div>

                                </div>

                                <div class="mt-4 border-t pt-3">
                                    <div class="text-xs uppercase text-gray-500 mb-2">
                                        Used Leave Dates 
                                    </div>

                                    @forelse($sickLeaveDates as $date)
                                        <div class="flex justify-between py-1">
                                            <span class="text-sm text-gray-700">
                                                {{ \Carbon\Carbon::parse($date)->format('M d, Y - D') }}
                                            </span>
                                        </div>
                                    @empty
                                        <div class="text-sm text-gray-400">
                                            No sick leaves used.
                                        </div>
                                    @endforelse

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FOOTER -->
            <div class="border-t bg-gray-50 px-6 py-4 flex justify-between items-center">

                <!-- SUCCESS -->
                <div>

                    @if (session()->has('success'))

                        <span class="text-sm text-green-600 font-medium">
                            {{ session('success') }}
                        </span>

                    @endif

                </div>

                <!-- BUTTONS -->
                <div class="flex gap-3">

                    <!-- CLOSE -->
                    <button
                        data-modal-hide="crud-modal"
                        class="px-5 py-2.5 border border-gray-300 rounded-xl hover:bg-gray-100 transition">

                        Close

                    </button>

                    <!-- EDIT -->
                    @if(!$isEditing)

                        <button
                            wire:click="editEmployee"
                            class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl transition">

                            Edit

                        </button>

                    @endif

                    <!-- SAVE -->
                    @if($isEditing)

                        <button
                            wire:click="updateEmployee"
                            class="px-5 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-xl transition">

                            Save Changes

                        </button>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>