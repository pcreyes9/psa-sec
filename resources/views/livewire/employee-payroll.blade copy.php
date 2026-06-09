<div class="grid grid-cols-1 md:grid-cols-4 gap-6">

    <!-- LEFT SIDE -->
    <div class="bg-white border rounded-2xl shadow-sm h-[77vh] overflow-hidden">

        <!-- HEADER -->
        <div class="p-4 border-b bg-gray-50">

            <h2 class="font-bold text-gray-800">
                Employees
            </h2>

            <p class="text-xs text-gray-500 mt-1">
                Select employee to preview payroll
            </p>

        </div>

        <!-- EMPLOYEE LIST -->
        <div class="overflow-y-auto h-full p-2 space-y-2">

            @foreach($employees as $employee)

                <button
                    wire:click="selectEmployee({{ $employee->id }})"
                    class="w-full text-left p-3 rounded-2xl border transition

                    {{ optional($selectedEmployee)->id == $employee->id
                        ? 'bg-blue-50 border-blue-200'
                        : 'hover:bg-gray-50 border-transparent' }}">

                    <div class="flex items-center gap-3">

                        <img
                            src="https://ui-avatars.com/api/?name={{ urlencode($employee->name) }}"
                            class="w-11 h-11 rounded-full">

                        <div>

                            <div class="font-semibold text-gray-800">
                                {{ $employee->name }}
                            </div>

                            <div class="text-xs text-gray-500">
                                {{ $employee->employee_code }}
                            </div>

                        </div>

                    </div>

                </button>

            @endforeach

        </div>

    </div>

    <!-- RIGHT SIDE -->
    <div class="md:col-span-3 space-y-6">

        <!-- FILTERS -->
        <div class="bg-white border rounded-2xl shadow-sm p-5">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <!-- MONTH -->
                <div>

                    <label class="text-xs uppercase text-gray-500">
                        Payroll Month
                    </label>

                    <input
                        type="month"
                        wire:model.live="month"
                        class="w-full mt-1 border rounded-xl p-3">

                </div>

                <!-- CUTOFF -->
                <div>

                    <label class="text-xs uppercase text-gray-500">
                        Cutoff
                    </label>

                    <select
                        wire:model.live="cutoff"
                        class="w-full mt-1 border rounded-xl p-3">

                        <option value="1">
                            1st Cutoff
                        </option>

                        <option value="2">
                            2nd Cutoff
                        </option>

                    </select>

                </div>

                <!-- FINALIZE -->
                <div class="flex items-end">

                    <button
                        wire:click="finalizePayroll"
                        class="w-full bg-green-600 hover:bg-green-700 text-white rounded-xl p-3 font-medium">

                        Finalize Payroll

                    </button>

                </div>

            </div>

        </div>

       
        @if($selectedEmployee)
            @if($attendanceRecords->isNotEmpty())

                <!-- PAYSLIP -->
                <div class="bg-white border rounded-2xl shadow-sm overflow-hidden">

                    <!-- HEADER -->
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-6 text-white">

                        <div class="flex items-start justify-between gap-6">

                            <!-- LEFT -->
                            <div class="flex items-center gap-4">

                                <img
                                    src="https://ui-avatars.com/api/?name={{ urlencode($selectedEmployee->name) }}&background=ffffff&color=2563eb"
                                    class="w-16 h-16 rounded-full border-4 border-white">

                                <div>

                                    <h1 class="text-2xl font-bold">
                                        {{ $selectedEmployee->name }}
                                    </h1>

                                    <p class="text-blue-100 text-sm">
                                        {{ $selectedEmployee->employee_code }}
                                    </p>

                                    <div class="mt-2">

                                        <span class="bg-white/20 px-3 py-1 rounded-full text-xs">

                                            {{ $cutoff == 1
                                                ? '1st Cutoff'
                                                : '2nd Cutoff' }}

                                        </span>

                                    </div>

                                </div>

                            </div>

                            <!-- RIGHT -->
                            <div class="text-right">

                                <div class="text-xs uppercase tracking-wide text-blue-100">
                                    Monthly Salary
                                </div>

                                <div class="mt-1 text-3xl font-bold">

                                    ₱{{ number_format($selectedEmployee->monthly_salary, 2) }}

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- BODY -->
                    <div class="p-6 space-y-6">

                        <!-- SUMMARY -->
                        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">

                            <!-- BASIC -->
                            <div class="bg-gray-50 border rounded-2xl p-4">

                                <div class="text-xs uppercase text-gray-500">
                                    Basic Pay
                                </div>

                                <div class="mt-2 text-xl font-bold">
                                    ₱{{ number_format($basicPay, 2) }}
                                </div>

                            </div>

                            <!-- ALLOWANCES -->
                            <div class="bg-gray-50 border rounded-2xl p-4">

                                <div class="text-xs uppercase text-gray-500">
                                    Allowances
                                </div>

                                <div class="mt-2 text-xl font-bold text-blue-600">
                                    ₱{{ number_format($allowances, 2) }}
                                </div>

                            </div>

                            <!-- DEDUCTIONS -->
                            <div class="bg-gray-50 border rounded-2xl p-4">

                                <div class="text-xs uppercase text-gray-500">
                                    Deductions
                                </div>

                                <div class="mt-2 text-xl font-bold text-orange-600">
                                    ₱{{ number_format($deductions, 2) }}
                                </div>

                            </div>

                            <!-- NET -->
                            <div class="bg-gray-50 border rounded-2xl p-4">

                                <div class="text-xs uppercase text-gray-500">
                                    Gross Pay
                                </div>

                                <div class="mt-2 text-xl font-bold text-black-600">
                                    ₱{{ number_format($grossPay, 2) }}
                                </div>

                            </div>

                            {{-- TOTAL --}}
                            <div class="bg-gray-50 border rounded-2xl p-4">

                                <div class="text-xs uppercase text-gray-500">
                                    Net Pay
                                </div>

                                <div class="mt-2 text-2xl font-bold text-green-600">
                                    ₱{{ number_format($netPay, 2) }}
                                </div>

                            </div>

                        </div>

                        <!-- ATTENDANCE SUMMARY -->
                        <div class="bg-gray-50 border rounded-2xl p-5">

                            <h3 class="text-lg font-bold text-gray-800 mb-5">
                                Premium Pay Summary
                            </h3>

                            <div class="overflow-x-auto">

                                <table class="w-full text-sm border rounded-xl overflow-hidden">

                                    <thead class="bg-gray-100">

                                        <tr>

                                            <th class="p-3 text-left">
                                                Description
                                            </th>

                                            <th class="p-3 text-center">
                                                Regular
                                            </th>

                                            <th class="p-3 text-center">
                                                Rest Day (130%)
                                            </th>

                                            <th class="p-3 text-center">
                                                Non-Working Holiday (130%)
                                            </th>

                                            <th class="p-3 text-center">
                                                Regular Holiday (200%)
                                            </th>

                                            <th class="p-3 text-center">
                                                Total
                                            </th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        <tr class="border-t">

                                            <td class="p-3 font-medium">
                                                Hours
                                            </td>

                                            <td class="p-3 text-center">
                                                {{ number_format($regularHours, 2) }}
                                            </td>

                                            <td class="p-3 text-center">
                                                {{ number_format($weekendHours, 2) }}
                                            </td>

                                            <td class="p-3 text-center">
                                                {{ number_format($nonWorkingHolidayHours, 2) }}
                                            </td>

                                            <td class="p-3 text-center">
                                                {{ number_format($regHolidayHours, 2) }}
                                            </td>

                                            <td class="p-3 text-center font-semibold">
                                                {{ number_format(
                                                    $regularHours +
                                                    $weekendHours +
                                                    $nonWorkingHolidayHours +
                                                    $regHolidayHours,
                                                    2
                                                ) }}
                                            </td>

                                        </tr>

                                        <tr class="border-t">

                                            <td class="p-3 font-medium">
                                                Hourly Rate
                                            </td>

                                            <td class="p-3 text-center">
                                                ₱{{ number_format($hourlyRate, 2) }}
                                            </td>

                                            <td class="p-3 text-center">
                                                ₱{{ number_format(
                                                    $hourlyRate *
                                                    ($settings['weekend_rate'] / 100),
                                                    2
                                                ) }}
                                            </td>

                                            <td class="p-3 text-center">
                                                ₱{{ number_format(
                                                    $hourlyRate *
                                                    ($settings['non_working_holiday_rate'] / 100),
                                                    2
                                                ) }}
                                            </td>

                                            <td class="p-3 text-center">
                                                ₱{{ number_format(
                                                    $hourlyRate *
                                                    ($settings['reg_holiday_rate'] / 100),
                                                    2
                                                ) }}
                                            </td>

                                            <td class="p-3 text-center">
                                                -
                                            </td>

                                        </tr>

                                        <tr class="border-t bg-green-50">

                                            <td class="p-3 font-medium">
                                                Amount
                                            </td>

                                            <td class="p-3 text-center font-semibold text-green-700">
                                                ₱{{ number_format($basicPay, 2) }}
                                            </td>

                                            <td class="p-3 text-center font-semibold text-green-700">
                                                ₱{{ number_format($weekendPay, 2) }}
                                            </td>

                                            <td class="p-3 text-center font-semibold text-green-700">
                                                ₱{{ number_format($nonWorkingHolidayPay, 2) }}
                                            </td>

                                            <td class="p-3 text-center font-semibold text-green-700">
                                                ₱{{ number_format($regHolidayPay, 2) }}
                                            </td>

                                            <td class="p-3 text-center font-bold text-green-700">

                                                ₱{{ number_format(
                                                    $basicPay +
                                                    $weekendPay +
                                                    $nonWorkingHolidayPay +
                                                    $regHolidayPay,
                                                    2
                                                ) }}

                                            </td>

                                        </tr>

                                    </tbody>

                                </table>

                            </div>

                        </div>

                        <div class="bg-gray-50 border rounded-2xl p-5">

                            <h3 class="text-lg font-bold text-gray-800 mb-5">
                                Overtime & Night Differential Summary
                            </h3>

                            <div class="overflow-x-auto">

                                <table class="w-full text-sm border rounded-xl overflow-hidden">

                                    <thead class="bg-gray-100">

                                        <tr>

                                            <th class="p-3 text-left">
                                                Description
                                            </th>

                                            <th class="p-3 text-center">
                                                Weekday OT
                                            </th>

                                            <th class="p-3 text-center">
                                                Rest Day OT
                                            </th>

                                            <th class="p-3 text-center">
                                                Special Holiday OT
                                            </th>

                                            <th class="p-3 text-center">
                                                Regular Holiday OT
                                            </th>

                                            <th class="p-3 text-center">
                                                Total
                                            </th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        {{-- OT HOURS --}}
                                        <tr class="border-t">

                                            <td class="p-3 font-medium">
                                                OT Hours
                                            </td>

                                            <td class="p-3 text-center">
                                                {{ number_format($weekdayOtHours, 2) }}
                                            </td>

                                            <td class="p-3 text-center">
                                                {{ number_format($weekendOtHours, 2) }}
                                            </td>

                                            <td class="p-3 text-center">
                                                {{ number_format($nonWorkingHolidayOT, 2) }}
                                            </td>

                                            <td class="p-3 text-center">
                                                {{ number_format($regHolidayOT, 2) }}
                                            </td>

                                            <td class="p-3 text-center font-semibold">
                                                {{ number_format(
                                                    $weekdayOtHours +
                                                    $weekendOtHours +
                                                    $nonWorkingHolidayOT +
                                                    $regHolidayOT,
                                                    2
                                                ) }}
                                            </td>

                                        </tr>

                                        {{-- OT RATE --}}
                                        <tr class="border-t bg-blue-50">

                                            <td class="p-3 font-medium">
                                                OT Rate/Hour
                                            </td>

                                            <td class="p-3 text-center">
                                                {{ $settings['weekday_ot_rate'] }}% - {{ number_format($hourlyRate * ($settings['weekday_ot_rate'] / 100), 2) }}
                                            </td>

                                            <td class="p-3 text-center">
                                                {{ $settings['weekend_ot_rate'] }}% - {{ number_format($hourlyRate * ($settings['weekend_ot_rate'] / 100), 2) }}

                                            </td>

                                            <td class="p-3 text-center">
                                                {{ $settings['non_working_holiday_ot_rate'] }}% - {{ number_format($hourlyRate * ($settings['non_working_holiday_ot_rate'] / 100), 2) }}
                                            </td>

                                            <td class="p-3 text-center">
                                               {{ $settings['reg_holiday_ot_rate'] }}% - {{ number_format($hourlyRate * ($settings['reg_holiday_ot_rate'] / 100), 2) }}
                                            </td>

                                            <td class="p-3 text-center font-semibold text-blue-700">
                                                ₱{{ number_format($weekdayOtPay + $weekendOtPay + $regHolidayOTPay + $nonWorkingHolidayOTPay, 2) }}
                                            </td>

                                        </tr>

                                        <tr>
                                            <td colspan="6" class="h-5 bg-white"></td>
                                        </tr>

                                        {{-- ND HOURS --}}
                                        <tr class="border-t">

                                            <td class="p-3 font-medium">
                                                ND Hours
                                            </td>

                                            <td class="p-3 text-center">
                                                {{ number_format($weekdayNdHours, 2) }}
                                            </td>

                                            <td class="p-3 text-center">
                                                {{ number_format($weekendNdHours, 2) }}
                                            </td>

                                            <td class="p-3 text-center">
                                                {{ number_format($specialHolidayNdHours, 2) }}
                                            </td>

                                            <td class="p-3 text-center">
                                                {{ number_format($regHolidayNdHours, 2) }}
                                            </td>

                                            <td class="p-3 text-center">
                                                {{ number_format(
                                                    $weekdayNdHours +
                                                    $weekendNdHours +
                                                    $specialHolidayNdHours +
                                                    $regHolidayNdHours,
                                                    2
                                                ) }}
                                            </td>

                                        </tr>

                                        {{-- ND RATE --}}
                                        <tr class="border-t bg-yellow-50">

                                            <td class="p-3 font-medium">
                                                ND Rate/Hour
                                            </td>

                                            <td class="p-3 text-center">
                                                {{ $settings['weekday_nd_rate'] }}% - {{ number_format($hourlyRate * ($settings['weekday_nd_rate'] / 100), 2) }}
                                            </td>

                                            <td class="p-3 text-center">
                                                {{ $settings['weekend_nd_rate'] }}% - {{ number_format($hourlyRate * ($settings['weekday_nd_rate'] / 100), 2) }}
                                            </td>

                                            <td class="p-3 text-center">
                                                {{ $settings['special_holiday_nd_rate'] }}% - {{ number_format($hourlyRate * ($settings['weekday_nd_rate'] / 100), 2) }}
                                            </td>

                                            <td class="p-3 text-center">
                                                {{ $settings['reg_holiday_nd_rate'] }}% - {{ number_format($hourlyRate * ($settings['weekday_nd_rate'] / 100), 2) }}
                                            </td>

                                            <td class="p-3 text-center font-semibold text-yellow-700">
                                                ₱{{ number_format($weekdayNdPay + $weekendNdPay + $regHolidayNdPay + $specialHolidayNdPay, 2) }}
                                            </td>

                                        </tr>

                                        <tr>
                                            <td colspan="6" class="h-5 bg-white"></td>
                                        </tr>

                                        {{-- AMOUNT --}}
                                        <tr class="border-t bg-green-50">

                                            <td class="p-3 font-medium">
                                                Amount
                                            </td>

                                            <td class="p-3 text-center font-semibold text-green-700">

                                                ₱{{ number_format(
                                                    $weekdayOtPay +
                                                    $weekdayNdPay,
                                                    2
                                                ) }}

                                            </td>

                                            <td class="p-3 text-center font-semibold text-green-700">

                                                ₱{{ number_format(
                                                    $weekendOtPay +
                                                    $weekendNdPay,
                                                    2
                                                ) }}

                                            </td>

                                            <td class="p-3 text-center font-semibold text-green-700">

                                                ₱{{ number_format(
                                                    $nonWorkingHolidayOTPay +
                                                    $specialHolidayNdPay,
                                                    2
                                                ) }}

                                            </td>

                                            <td class="p-3 text-center font-semibold text-green-700">

                                                ₱{{ number_format(
                                                    $regHolidayOTPay +
                                                    $regHolidayNdPay,
                                                    2
                                                ) }}

                                            </td>

                                            <td class="p-3 text-center font-bold text-green-700">

                                                ₱{{ number_format(
                                                    $overtimePay,
                                                    2
                                                ) }}

                                            </td>

                                        </tr>

                                    </tbody>

                                </table>

                            </div>

                        </div>

                        <!-- ALLOWANCES -->
                        <div class="bg-gray-50 border rounded-2xl p-5">

                            <h3 class="text-lg font-bold text-gray-800 mb-5">
                                Allowance Breakdown
                            </h3>

                            <div class="space-y-3">

                                @forelse($selectedEmployee->allowances as $allowance)
                                    <div class="flex items-center justify-between bg-white border rounded-2xl p-4">

                                        <div>

                                            <div class="font-medium text-gray-800">
                                                {{ $allowance->name }}
                                            </div>

                                            <div class="text-xs text-gray-500">

                                                Monthly:
                                                ₱{{ number_format($allowance->amount, 2) }}

                                            </div>

                                        </div>

                                        <div class="text-right">

                                            <div class="text-xs text-gray-500">
                                                Per Cutoff
                                            </div>

                                            <div class="font-bold text-blue-600">

                                                ₱{{ number_format($allowance->amount / 2, 2) }}

                                            </div>

                                        </div>
                                            
                                    </div>

                                @empty

                                    <div class="text-sm text-gray-500">
                                        No allowances found.
                                    </div>

                                @endforelse
                                <div class="border-t pt-4 flex justify-between items-center">

                                    <span class="font-semibold text-gray-700">
                                        Total Allowances
                                    </span>

                                    <span class="font-bold text-lg text-blue-600">
                                        ₱{{ number_format($allowances, 2) }}
                                    </span>

                                </div>

                            </div>

                        </div>

                        <!-- DEDUCTIONS -->
                        <div class="bg-gray-50 border rounded-2xl p-5">

                            <h3 class="text-lg font-bold text-gray-800 mb-5">
                                Deductions
                            </h3>

                            <div class="space-y-3">

                                @if($cutoff == '1')

                                    @foreach($deductionBreakdown as $deduction)

                                        @if($deduction['amount'] > 0)

                                            <div class="flex items-center justify-between bg-white border rounded-xl p-4">

                                                <div>

                                                    <div class="font-medium text-gray-800">
                                                        {{ $deduction['name'] }}
                                                    </div>

                                                    <div class="text-xs text-gray-500">
                                                        {{ $deduction['type'] }}
                                                    </div>

                                                </div>
                                                
                                                
                                                <div class=" text-red-600">
                                                    <div class="text-xs text-right text-gray-500">
                                                        Per Cutoff
                                                    </div>

                                                    ₱{{ number_format($deduction['amount'], 2) }}
                                                </div>

                                            </div>

                                        @endif

                                    @endforeach

                                @endif

                                @if($lateDeduction > 0)

                                    <div class="flex items-center justify-between bg-white border rounded-xl p-4">

                                        <div>

                                            <div class="font-medium text-gray-800">
                                                Late Deduction
                                            </div>

                                            <div class="text-xs text-gray-500">
                                                Attendance Penalty
                                            </div>

                                        </div>

                                        <div class="font-bold text-red-600">
                                            ₱{{ number_format($lateDeduction, 2) }}
                                        </div>

                                    </div>

                                @endif

                                @if($taxDeduction > 0)

                                    <div class="flex items-center justify-between bg-yellow-50 border border-yellow-200 rounded-xl p-4">

                                        <div>

                                            <div class="font-medium text-yellow-800">
                                                Withholding Tax
                                            </div>

                                            <div class="text-xs text-yellow-600">
                                                Computed Tax
                                            </div>

                                        </div>

                                        <div class="font-bold text-red-600">
                                            ₱{{ number_format($taxDeduction, 2) }}
                                        </div>

                                    </div>

                                @endif

                                <div class="border-t pt-4 flex justify-between items-center">

                                    <span class="font-semibold text-gray-700">
                                        Total Deductions
                                    </span>

                                    <span class="font-bold text-lg text-red-600">
                                        ₱{{ number_format($deductions, 2) }}
                                    </span>

                                </div>

                            </div>

                        </div>
                        
                        <!-- TIME RECORDS -->
                        <div class="bg-gray-50 border rounded-2xl p-5">

                            <h3 class="text-lg font-bold text-gray-800 mb-5">
                                Time Records
                            </h3>

                            <div class="overflow-auto max-h-[1000px] border rounded-2xl bg-white">

                                <table class="w-full text-sm">

                                    <thead class="bg-gray-100 sticky top-0">

                                        <tr>

                                            <th class="text-left p-3">
                                                Date
                                            </th>

                                            <th class="text-left p-3">
                                                Status
                                            </th>

                                            <th class="text-left p-3">
                                                Time In
                                            </th>

                                            <th class="text-left p-3">
                                                Time Out
                                            </th>

                                            <th class="text-left p-3">
                                                Hours
                                            </th>

                                            <th class="text-left p-3">
                                                OT
                                            </th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        @foreach($attendanceRecords as $att)

                                            @php
                                                $isWeekend = \Carbon\Carbon::parse(
                                                    $att->attendance_date
                                                )->isWeekend();
                                            @endphp

                                            <tr class="border-t">

                                                <!-- DATE -->
                                                <td class="p-3">

                                                    <div>
                                                        {{ \Carbon\Carbon::parse($att->attendance_date)->format('M d, Y') }}
                                                    </div>

                                                    <div class="text-xs text-gray-500">
                                                        {{ \Carbon\Carbon::parse($att->attendance_date)->format('l') }}
                                                    </div>

                                                </td>

                                                <!-- STATUS -->
                                                <td class="p-3">

                                                    @switch($att->status)

                                                        @case('Present')

                                                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                                                Present
                                                            </span>

                                                            @break

                                                        @case('Late')

                                                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                                                                Late
                                                            </span>

                                                            @break

                                                        @case('Absent')

                                                            <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">
                                                                Absent
                                                            </span>

                                                            @break

                                                        @case('Vacation Leave')

                                                            <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-700">
                                                                Vacation Leave
                                                            </span>

                                                            @break

                                                        @case('Sick Leave')

                                                            <span class="px-2 py-1 text-xs rounded-full bg-purple-100 text-purple-700">
                                                                Sick Leave
                                                            </span>

                                                            @break
                                                        @case('Regular Holiday')

                                                            <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-700">
                                                                Regular Holiday (200%)
                                                            </span>

                                                            @break

                                                        @case('Non Working Holiday')

                                                            <span class="px-2 py-1 text-xs rounded-full bg-purple-100 text-purple-700">
                                                                Non Working Holiday (130%)
                                                            </span>

                                                            @break

                                                        @default

                                                            <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">
                                                                {{ $att->status }}
                                                            </span>

                                                    @endswitch

                                                </td>

                                                <!-- TIME IN -->
                                                <td class="p-3">

                                                    @if($att->time_in)

                                                        {{ \Carbon\Carbon::parse($att->time_in)->format('h:i A') }}

                                                    @else

                                                        -

                                                    @endif

                                                </td>

                                                <!-- TIME OUT -->
                                                <td class="p-3">

                                                    @if($att->time_out)

                                                        {{ \Carbon\Carbon::parse($att->time_out)->format('h:i A') }}

                                                    @else

                                                        -

                                                    @endif

                                                </td>

                                                <!-- HOURS -->
                                                <td class="p-3">

                                                    @if(
                                                        in_array(
                                                            $att->status,
                                                            [
                                                                'Present',
                                                                'Late',
                                                                'Half Day',
                                                                'Regular Holiday',
                                                                'Special Non-Working Holiday'
                                                            ]
                                                        )
                                                    )
                                                        {{ number_format($att->total_hours, 2) }}

                                                    @else
                                                        -
                                                    @endif
                                                </td>

                                                <!-- OT -->
                                                <td class="p-3">

                                                    @if(
                                                        in_array(
                                                            $att->status,
                                                            [
                                                                'Present',
                                                                'Late',
                                                                'Half Day',
                                                                'Regular Holiday',
                                                                'Special Non-Working Holiday'
                                                            ]
                                                        ) &&
                                                        $att->overtime_hours > 1
                                                    )

                                                        <div class="font-semibold text-orange-600">
                                                            {{ number_format($att->overtime_hours, 2) }}
                                                        </div>

                                                        <div class="text-xs">

                                                            @if($att->status == 'Regular Holiday')

                                                                <span class="text-blue-600">
                                                                    Regular Holiday (230%)
                                                                </span>

                                                            @elseif($att->status == 'Non Working Holiday')

                                                                <span class="text-purple-600">
                                                                    Non Working Holiday (160%)
                                                                </span>

                                                            @elseif($isWeekend)

                                                                <span class="text-red-500">
                                                                    Weekend OT (130%)
                                                                </span>

                                                            @else

                                                                <span class="text-green-500">
                                                                    Weekday OT (125%)
                                                                </span>

                                                            @endif

                                                        </div>

                                                    @else

                                                        -

                                                    @endif

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- SUMMARY -->
                            <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mt-5">

                                <!-- BASIC -->
                                <div class="bg-gray-50 border rounded-2xl p-4">

                                    <div class="text-xs uppercase text-gray-500">
                                        Overtime
                                    </div>

                                    <div class="mt-2 text-xl font-bold">
                                        ₱{{ number_format($basicPay, 2) }}
                                    </div>

                                </div>

                                <!-- ALLOWANCES -->
                                <div class="bg-gray-50 border rounded-2xl p-4">

                                    <div class="text-xs uppercase text-gray-500">
                                        Holiday
                                    </div>

                                    <div class="mt-2 text-xl font-bold text-blue-600">
                                        ₱{{ number_format($allowances, 2) }}
                                    </div>

                                </div>

                                <!-- DEDUCTIONS -->
                                <div class="bg-gray-50 border rounded-2xl p-4">

                                    <div class="text-xs uppercase text-gray-500">
                                        Deductions
                                    </div>

                                    <div class="mt-2 text-xl font-bold text-orange-600">
                                        ₱{{ number_format($deductions, 2) }}
                                    </div>

                                </div>

                                <!-- NET -->
                                <div class="bg-gray-50 border rounded-2xl p-4">

                                    <div class="text-xs uppercase text-gray-500">
                                        Gross Pay
                                    </div>

                                    <div class="mt-2 text-xl font-bold text-black-600">
                                        ₱{{ number_format($grossPay, 2) }}
                                    </div>

                                </div>

                                {{-- TOTAL --}}
                                <div class="bg-gray-50 border rounded-2xl p-4">

                                    <div class="text-xs uppercase text-gray-500">
                                        Net Pay
                                    </div>

                                    <div class="mt-2 text-2xl font-bold text-green-600">
                                        ₱{{ number_format($netPay, 2) }}
                                    </div>

                                </div>

                            </div>
                            
                        </div>

                        

                        <!-- APPROVE -->
                        <div class="flex justify-end">
                            <button
                                wire:click="approvePayroll"
                                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-medium">

                                Approve Payroll

                            </button>
                        </div>
                    </div>
                </div>
            @else
                <!-- EMPTY STATE -->
                <div class="bg-white border rounded-2xl shadow-sm flex flex-col items-center justify-center h-[34.5vh] text-center p-6">
                    <div class="text-6xl mb-4">
                        📅
                    </div>

                    <h2 class="text-xl font-bold text-gray-700 mb-2">
                        No Record Found
                    </h2>

                    <p class="text-gray-500 max-w-md">
                        Maybe you are looking at the wrong month or cutoff? Try changing the filters above.
                    </p>
                </div>
            @endif
        @else

            <!-- EMPTY -->
            <div class="bg-white border rounded-2xl shadow-sm p-16 text-center">
                <div class="text-5xl mb-4">
                    💼
                </div>

                <h2 class="text-xl font-bold text-gray-700">
                    No Employee Selected
                </h2>

                <p class="text-sm text-gray-500 mt-2">
                    Select an employee from the left side to preview payroll.
                </p>
            </div>
        @endif
    </div>
</div>