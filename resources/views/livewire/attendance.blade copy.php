<div class="space-y-6 mx-2 my-2">

    @if(session()->has('success'))

        <div class="bg-green-100 text-green-700 border border-green-300 rounded-xl p-3">
            {{ session('success') }}
        </div>

    @endif

    <div
        x-data="{
            now: new Date(),
            init() {
                setInterval(() => {
                    this.now = new Date();
                }, 1000);
            }
        }"
        class="bg-white border rounded-2xl p-5">

        <!-- HEADER -->
        <div class="flex items-center mb-6">

            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    Attendance Monitoring
                </h2>

                <p class="text-sm text-gray-500">
                    PSA Timekeeping System
                </p>
            </div>

            <div
                x-data="{ now: new Date(), init() { setInterval(() => this.now = new Date(), 1000) } }"
                class="ml-auto text-right">

                <div
                    class="text-5xl font-bold text-blue-600"
                    x-text="now.toLocaleTimeString()">
                </div>

                <div
                    class="text-sm text-gray-500"
                    x-text="now.toLocaleDateString('en-PH', {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    })">
                </div>

            </div>
        </div>

        <!-- FORM -->
        <div class="grid md:grid-cols-4 gap-4">

            <div class="md:col-span-3">

                <label class="block text-sm mb-2">
                    Employee
                </label>

                <select
                    wire:model.live="selectedEmployee"
                    class="w-full rounded-xl border-gray-300">

                    <option value="">
                        Select Employee
                    </option>

                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">
                            {{ $employee->employee_code }} - {{ $employee->name }}
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
                        @disabled(!$canTimeIn)
                        class="flex-1 py-2 rounded-xl font-medium transition
                            {{ $canTimeIn
                                ? 'bg-green-600 hover:bg-green-700 text-white'
                                : 'bg-gray-200 text-gray-700 cursor-not-allowed' }}">

                        {{ $canTimeIn ? 'Time In' : 'Already Timed In' }}

                    </button>

                    <button
                        wire:click="timeOut"
                        @disabled(!$canTimeOut)
                        class="flex-1 py-2 rounded-xl font-medium transition
                            {{ $canTimeOut
                                ? 'bg-red-600 hover:bg-red-700 text-white'
                                : 'bg-gray-200 text-gray-700 cursor-not-allowed' }}">

                        {{ $canTimeOut ? 'Time Out' : 'Disabled' }}

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