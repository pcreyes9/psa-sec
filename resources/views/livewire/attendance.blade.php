<div class="space-y-6 p-4">

    <x-flash-message />

    {{-- HEADER --}}
    <div
        x-data="{
            now: new Date(),
            init() {
                setInterval(() => {
                    this.now = new Date();
                }, 1000);
            }
        }"
        class="bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-700 rounded-3xl p-6 text-white shadow-lg">

        <div class="flex flex-col lg:flex-row lg:items-center">

            <div>

                <h1 class="text-3xl font-bold">
                    Attendance Monitoring
                </h1>

                <p class="text-blue-100 mt-1">
                    PSA Timekeeping System
                </p>

            </div>

            <div class="ml-auto text-right mt-4 lg:mt-0">

                <div
                    class="text-6xl font-extrabold tracking-tight text-white drop-shadow-lg"
                    x-text="now.toLocaleTimeString()">
                </div>

                <div
                    class="text-white"
                    x-text="now.toLocaleDateString('en-PH', {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    })">
                </div>

            </div>

        </div>

    </div>

    {{-- TIME IN / OUT --}}
    <div class="bg-white rounded-3xl border border-gray-200 shadow-sm p-6">

        <div class="grid lg:grid-cols-4 gap-5">

            <div class="lg:col-span-3">

                <label class="block text-sm font-medium text-gray-600 mb-2">
                    Select Employee
                </label>

                <select
                    wire:model.live="selectedEmployee"
                    class="w-full rounded-2xl border-gray-300 focus:ring-2 focus:ring-blue-500">

                    <option value="">
                        Select Employee
                    </option>

                    @foreach($employees as $employee)

                        <option value="{{ $employee->id }}">
                            {{ $employee->employee_code }}
                            -
                            {{ $employee->name }}
                        </option>

                    @endforeach

                </select>

            </div>

            <div>

                <label class="block text-sm font-medium text-gray-600 mb-2">
                    Actions
                </label>

                <div class="flex gap-2">

                    <button
                        wire:click="timeIn"
                        @disabled(!$canTimeIn)
                        class="flex-1 py-3 rounded-2xl font-semibold transition

                        {{ $canTimeIn
                            ? 'bg-green-600 hover:bg-green-700 text-white'
                            : 'bg-gray-200 text-gray-700 cursor-not-allowed border border-gray-300' }}">

                        ⏱ Time In

                    </button>

                    <button
                        wire:click="timeOut"
                        @disabled(!$canTimeOut)
                        class="flex-1 py-3 rounded-2xl font-semibold transition

                        {{ $canTimeOut
                            ? 'bg-red-600 hover:bg-red-700 text-white'
                            : 'bg-gray-200 text-gray-700 cursor-not-allowed border border-gray-300' }}">

                        🚪 Time Out

                    </button>

                </div>

            </div>

        </div>

    </div>

    {{-- SUMMARY --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <div class="bg-white border rounded-3xl p-5 shadow-sm">

            <div class="text-sm text-gray-500">
                Present Today
            </div>

            <div class="text-3xl font-bold text-blue-600 mt-2">
                {{ $this->todayAttendance->count() }}
            </div>

        </div>

        <div class="bg-white border rounded-3xl p-5 shadow-sm">

            <div class="text-sm text-gray-500">
                Timed In
            </div>

            <div class="text-3xl font-bold text-orange-600 mt-2">
                {{ $this->todayAttendance->whereNotNull('time_in')->count() }}
            </div>

        </div>

        <div class="bg-white border rounded-3xl p-5 shadow-sm">

            <div class="text-sm text-gray-500">
                Completed
            </div>

            <div class="text-3xl font-bold text-green-600 mt-2">
                {{ $this->todayAttendance->whereNotNull('time_out')->count() }}
            </div>

        </div>

    </div>

    {{-- ATTENDANCE TABLE --}}
    <div class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">

        <div class="px-6 py-4 border-b">

            <h3 class="text-lg font-bold text-gray-800">
                Today's Attendance
            </h3>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr class="text-xs uppercase tracking-wide text-gray-500">

                        <th class="px-6 py-4 text-left">
                            Employee
                        </th>

                        <th class="px-6 py-4 text-left">
                            Time In
                        </th>

                        <th class="px-6 py-4 text-left">
                            Time Out
                        </th>

                        <th class="px-6 py-4 text-left">
                            Hours
                        </th>

                        <th class="px-6 py-4 text-left">
                            Status
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-100">

                    @forelse($this->todayAttendance as $attendance)

                        <tr class="hover:bg-gray-50 transition">

                            <td class="px-6 py-4 font-medium text-gray-800">
                                {{ $attendance->employee->name }}
                            </td>

                            <td class="px-6 py-4 text-gray-600">

                                {{ $attendance->time_in
                                    ? \Carbon\Carbon::parse($attendance->time_in)->format('h:i A')
                                    : '-' }}

                            </td>

                            <td class="px-6 py-4 text-gray-600">

                                {{ $attendance->time_out
                                    ? \Carbon\Carbon::parse($attendance->time_out)->format('h:i A')
                                    : '-' }}

                            </td>

                            <td class="px-6 py-4 font-semibold">

                                {{ number_format(
                                    $attendance->total_hours ?? 0,
                                    2
                                ) }}

                            </td>

                            <td class="px-6 py-4">

                                @php

                                    $statusColors = [
                                        'Present' => 'bg-green-100 text-green-700',
                                        'Late' => 'bg-yellow-100 text-yellow-700',
                                        'Absent' => 'bg-red-100 text-red-700',
                                        'Vacation Leave' => 'bg-blue-100 text-blue-700',
                                        'Sick Leave' => 'bg-purple-100 text-purple-700',
                                    ];

                                @endphp

                                <span class="px-3 py-1 rounded-full text-xs font-medium

                                    {{ $statusColors[$attendance->status] ?? 'bg-gray-100 text-gray-700' }}">

                                    {{ $attendance->status }}

                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="5"
                                class="text-center py-12 text-gray-500">

                                No attendance records found today.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>