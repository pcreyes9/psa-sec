<div class="space-y-6 mx-2 my-2">

    @if(session()->has('success'))

        <div class="bg-green-100 text-green-700 border border-green-300 rounded-xl p-3">
            {{ session('success') }}
        </div>

    @endif

    <div class="bg-white border rounded-2xl p-5">

        <h2 class="text-xl font-bold mb-4">
            Attendance Monitoring
        </h2>

        <div class="grid md:grid-cols-3 gap-4">

            <div class="md:col-span-2">

                <label class="block text-sm mb-2">
                    Employee
                </label>

                <select
                    wire:model="selectedEmployee"
                    class="w-full rounded-xl border-gray-300">

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

                <label class="block text-sm mb-2">
                    Actions
                </label>

                <div class="flex gap-2">

                    <button
                        wire:click="timeIn"
                        class="flex-1 bg-green-600 text-white py-2 rounded-xl">

                        Time In

                    </button>

                    <button
                        wire:click="timeOut"
                        class="flex-1 bg-red-600 text-white py-2 rounded-xl">

                        Time Out

                    </button>

                </div>

            </div>

        </div>

    </div>

    <div class="bg-white border rounded-2xl p-5">

        <h3 class="text-lg font-bold mb-4">
            Today's Attendance
        </h3>

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="p-3 text-left">
                            Employee
                        </th>

                        <th class="p-3 text-left">
                            Time In
                        </th>

                        <th class="p-3 text-left">
                            Time Out
                        </th>

                        <th class="p-3 text-left">
                            Hours
                        </th>

                        <th class="p-3 text-left">
                            Status
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($this->todayAttendance as $attendance)

                        <tr class="border-t">

                            <td class="p-3">
                                {{ $attendance->employee->name }}
                            </td>

                            <td class="p-3">

                                @if($attendance->time_in)

                                    {{ \Carbon\Carbon::parse(
                                        $attendance->time_in
                                    )->format('h:i A') }}

                                @else
                                    -
                                @endif

                            </td>

                            <td class="p-3">

                                @if($attendance->time_out)

                                    {{ \Carbon\Carbon::parse(
                                        $attendance->time_out
                                    )->format('h:i A') }}

                                @else
                                    -
                                @endif

                            </td>

                            <td class="p-3">
                                {{ number_format(
                                    $attendance->total_hours ?? 0,
                                    2
                                ) }}
                            </td>

                            <td class="p-3">

                                <span class="px-3 py-1 rounded-full text-xs bg-green-100 text-green-700">

                                    {{ $attendance->status }}

                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="5"
                                class="p-5 text-center text-gray-500">

                                No attendance records today.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>