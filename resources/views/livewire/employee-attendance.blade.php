<div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

    <!-- LEFT PANEL -->
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

        <!-- HEADER -->
        <div class="p-4 border-b bg-gray-50">

            <h2 class="text-lg font-bold text-gray-800">
                Employees
            </h2>

            <p class="text-sm text-gray-500">
                Select an employee to view attendance
            </p>

        </div>

        <!-- EMPLOYEE LIST -->
        <div class="max-h-[85vh] overflow-y-auto p-2 space-y-1">

            @foreach($employees as $emp)

                <button
                    wire:click="selectEmployee({{ $emp->id }})"
                    class="w-full flex items-center gap-3 p-3 rounded-xl transition border

                        {{ optional($selectedEmployee)->id === $emp->id
                            ? 'bg-blue-50 border-blue-200'
                            : 'hover:bg-gray-50 border-transparent' }}">

                    <!-- AVATAR -->
                    <img
                        src="https://ui-avatars.com/api/?name={{ urlencode($emp->name) }}"
                        class="w-11 h-11 rounded-full">

                    <!-- INFO -->
                    <div class="text-left">

                        <div class="font-semibold text-gray-800">
                            {{ $emp->name }}
                        </div>

                        <div class="text-xs text-gray-500">
                            {{ $emp->employee_code }}
                        </div>

                    </div>

                </button>

            @endforeach

        </div>

    </div>

    <!-- RIGHT PANEL -->
    <div class="lg:col-span-3 bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

        @if($selectedEmployee)

            <!-- HEADER -->
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 p-6 border-b bg-gray-50">

                <div class="flex items-center gap-4">

                    <img
                        src="https://ui-avatars.com/api/?name={{ urlencode($selectedEmployee->name) }}"
                        class="w-16 h-16 rounded-full">

                    <div>

                        <h2 class="text-2xl font-bold text-gray-800">
                            {{ $selectedEmployee->name }}
                        </h2>

                        <div class="flex flex-wrap items-center gap-2 mt-1 text-sm text-gray-500">

                            <span>
                                {{ $selectedEmployee->employee_code }}
                            </span>

                            <span>•</span>

                            <span>
                                {{ $selectedEmployee->position }}
                            </span>
                            
                        </div>

                    </div>

                </div>

                <!-- STATUS -->
                <span class="px-3 py-1 text-xs rounded-full font-medium w-fit

                    {{ $selectedEmployee->status === 'Active'
                        ? 'bg-green-100 text-green-700'
                        : 'bg-red-100 text-red-700' }}">

                    {{ $selectedEmployee->status }}

                </span>

            </div>

            <!-- FILTERS -->
            <div class="p-4 border-b bg-white">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    <!-- MONTH -->
                    <div>

                        <label class="text-xs text-gray-500 mb-1 block">
                            Payroll Month
                        </label>

                        <input
                            type="month"
                            wire:model.live="month"
                            class="w-full border border-gray-300 rounded-xl p-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                    </div>

                    <!-- CUTOFF -->
                    <div>

                        <label class="text-xs text-gray-500 mb-1 block">
                            Cutoff
                        </label>

                        <select
                            wire:model.live="cutoff"
                            class="w-full border border-gray-300 rounded-xl p-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                            <option value="1">
                                1st Cutoff (1–15)
                            </option>

                            <option value="2">
                                2nd Cutoff (16–End)
                            </option>

                        </select>

                    </div>

                    <!-- STATUS -->
                    <div>

                        <label class="text-xs text-gray-500 mb-1 block">
                            Status
                        </label>

                        <select
                            wire:model.live="status"
                            class="w-full border border-gray-300 rounded-xl p-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                            <option value="">All Status</option>
                            <option value="Present">Present</option>
                            <option value="Late">Late</option>
                            <option value="Absent">Absent</option>
                            <option value="Vacation Leave">Vacation Leave</option>
                            <option value="Sick Leave">Sick Leave</option>

                        </select>

                    </div>

                </div>

            </div>

            <!-- SUMMARY -->
            @php

                $cutoffTotalHours = 0;
                $cutoffTotalOT = 0;
                $totalDaysPresent = 0;

                foreach ($attendance as $att) {

                    $hours = 0;
                    $overtime = 0;

                    if ($att->time_in && $att->time_out) {

                        $timeIn = \Carbon\Carbon::parse($att->time_in);
                        $timeOut = \Carbon\Carbon::parse($att->time_out);

                        $hours = $timeIn->diffInMinutes($timeOut) / 60;

                        // OT after 10 hrs
                        $computedOT = max(0, $hours - 10);

                        // Ignore OT if <= 1 hr
                        $overtime = $computedOT > 1
                            ? $computedOT
                            : 0;

                        $cutoffTotalHours += $hours;
                        $cutoffTotalOT += $overtime;
                    }

                    if ($att->status === 'Present') {
                        $totalDaysPresent++;
                    }
                }

            @endphp

            <!-- SUMMARY CARDS -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4 border-b bg-gray-50">

                <!-- TOTAL HOURS -->
                <div class="bg-white border border-blue-100 rounded-2xl p-5 shadow-sm">

                    <div class="text-xs uppercase tracking-wide text-blue-500">
                        Total Rendered Hours
                    </div>

                    <div class="text-3xl font-bold text-blue-700 mt-2">
                        {{ number_format($cutoffTotalHours, 2) }}
                    </div>

                </div>

                <!-- TOTAL OT -->
                <div class="bg-white border border-orange-100 rounded-2xl p-5 shadow-sm">

                    <div class="text-xs uppercase tracking-wide text-orange-500">
                        Total Overtime
                    </div>

                    <div class="text-3xl font-bold text-orange-600 mt-2">
                        {{ number_format($cutoffTotalOT, 2) }}
                    </div>

                </div>

                <!-- DAYS PRESENT -->
                <div class="bg-white border border-green-100 rounded-2xl p-5 shadow-sm">

                    <div class="text-xs uppercase tracking-wide text-green-500">
                        Days Present
                    </div>

                    <div class="text-3xl font-bold text-green-700 mt-2">
                        {{ $totalDaysPresent }}
                    </div>

                </div>

            </div>

            <!-- TABLE -->
            <div class="overflow-auto max-h-[100vh]">

                <table class="w-full text-sm text-left">

                    <thead class="bg-gray-100 sticky top-0 z-10">

                        <tr class="text-gray-700 uppercase text-xs">

                            <th class="px-4 py-3 font-semibold">
                                Date
                            </th>

                            <th class="px-4 py-3 font-semibold">
                                Time In
                            </th>

                            <th class="px-4 py-3 font-semibold">
                                Time Out
                            </th>

                            <th class="px-4 py-3 font-semibold">
                                Hours
                            </th>

                            <th class="px-4 py-3 font-semibold">
                                OT
                            </th>

                            <th class="px-4 py-3 font-semibold">
                                Status
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        @forelse($attendance as $att)

                            @php

                                $hours = 0;
                                $overtime = 0;

                                if ($att->time_in && $att->time_out) {

                                    $timeIn = \Carbon\Carbon::parse($att->time_in);
                                    $timeOut = \Carbon\Carbon::parse($att->time_out);

                                    $hours = $timeIn->diffInMinutes($timeOut) / 60;

                                    // OT after 10 hrs
                                    $computedOT = max(0, $hours - 10);

                                    // Ignore OT if <= 1 hr
                                    $overtime = $computedOT > 1
                                        ? $computedOT
                                        : 0;
                                }

                            @endphp

                            <tr class="hover:bg-gray-50 transition">

                                <!-- DATE -->
                                <td class="px-4 py-3">

                                    <div class="font-medium text-gray-800">
                                        {{ \Carbon\Carbon::parse($att->attendance_date)->format('M d, Y') }}
                                    </div>

                                    <div class="text-xs uppercase tracking-wide text-gray-400">
                                        {{ \Carbon\Carbon::parse($att->attendance_date)->format('l') }}
                                    </div>

                                </td>

                                <!-- TIME IN -->
                                <td class="px-4 py-3 text-gray-600">

                                    {{ $att->time_in
                                        ? \Carbon\Carbon::parse($att->time_in)->format('h:i A')
                                        : '-' }}

                                </td>

                                <!-- TIME OUT -->
                                <td class="px-4 py-3 text-gray-600">

                                    {{ $att->time_out
                                        ? \Carbon\Carbon::parse($att->time_out)->format('h:i A')
                                        : '-' }}

                                </td>

                                <!-- HOURS -->
                                <td class="px-4 py-3 font-semibold text-gray-700">

                                    {{ number_format($hours, 2) }}

                                </td>

                                <!-- OT -->
                                <td class="px-4 py-3 font-semibold text-orange-600">

                                    {{ number_format($overtime, 2) }}

                                </td>

                                <!-- STATUS -->
                                <td class="px-4 py-3">

                                    <span class="px-2.5 py-1 text-xs rounded-full font-medium

                                        {{ $att->status === 'Present'
                                            ? 'bg-green-100 text-green-700'
                                            : ($att->status === 'Late'
                                                ? 'bg-yellow-100 text-yellow-700'
                                                : ($att->status === 'Vacation Leave'
                                                    ? 'bg-blue-100 text-blue-700'
                                                    : 'bg-red-100 text-red-700')) }}">


                                        {{ $att->status }}

                                    </span>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6"
                                    class="text-center py-12 text-gray-500">

                                    No attendance records found

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        @else

            <!-- EMPTY STATE -->
            <div class="flex flex-col items-center justify-center h-[80vh] text-center p-6">

                <div class="text-6xl mb-4">
                    📅
                </div>

                <h2 class="text-xl font-bold text-gray-700 mb-2">
                    No Employee Selected
                </h2>

                <p class="text-gray-500 max-w-md">
                    Select an employee from the left panel to view attendance records.
                </p>

            </div>

        @endif

    </div>

</div>