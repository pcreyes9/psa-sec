<div class="space-y-6">

    <!-- HEADER -->
    <div class="bg-white border rounded-2xl shadow-sm p-6">

        <h1 class="text-2xl font-bold text-gray-800">
            Payroll Generator
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Generate payroll from attendance records
        </p>

    </div>

    <!-- FILTERS -->
    <div class="bg-white border rounded-2xl shadow-sm p-6">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <!-- MONTH -->
            <div>

                <label class="text-xs text-gray-500 mb-1 block">
                    Payroll Month
                </label>

                <input
                    type="month"
                    wire:model="month"
                    class="w-full border border-gray-300 rounded-xl p-2.5">

            </div>

            <!-- CUTOFF -->
            <div>

                <label class="text-xs text-gray-500 mb-1 block">
                    Cutoff
                </label>

                <select
                    wire:model="cutoff"
                    class="w-full border border-gray-300 rounded-xl p-2.5">

                    <option value="1">
                        1st Cutoff (1–15)
                    </option>

                    <option value="2">
                        2nd Cutoff (16–End)
                    </option>

                </select>

            </div>

            <!-- BUTTON -->
            <div class="flex items-end">

                <button
                    wire:click="generatePayroll"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white rounded-xl px-4 py-2.5 font-medium">

                    Generate Payroll

                </button>

            </div>

        </div>

    </div>

    <!-- RESULTS -->
    @if($generatedPayroll)

        <!-- SUMMARY -->
        <div class="bg-white border rounded-2xl shadow-sm p-6">

            <div class="flex items-center justify-between">

                <div>

                    <h2 class="text-xl font-bold text-gray-800">
                        {{ $generatedPayroll->payroll_code }}
                    </h2>

                    <p class="text-sm text-gray-500">
                        {{ $generatedPayroll->month }}
                        •
                        {{ $generatedPayroll->cutoff == 1 ? '1st Cutoff' : '2nd Cutoff' }}
                    </p>

                </div>

                <div class="text-right">

                    <div class="text-xs uppercase tracking-wide text-gray-500">
                        Total Payroll
                    </div>

                    <div class="text-3xl font-bold text-green-600">
                        ₱{{ number_format($generatedPayroll->total_amount, 2) }}
                    </div>

                </div>

            </div>

        </div>

        <!-- TABLE -->
        <div class="bg-white border rounded-2xl shadow-sm overflow-hidden">

            <div class="overflow-auto">

                <table class="w-full text-sm text-left">

                    <thead class="bg-gray-100 text-xs uppercase text-gray-600">

                        <tr>

                            <th class="px-4 py-3">
                                Employee
                            </th>

                            <th class="px-4 py-3">
                                Days
                            </th>

                            <th class="px-4 py-3">
                                Regular Hours
                            </th>

                            <th class="px-4 py-3">
                                OT Hours
                            </th>

                            <th class="px-4 py-3">
                                Basic Pay
                            </th>

                            <th class="px-4 py-3">
                                OT Pay
                            </th>

                            <th class="px-4 py-3">
                                Allowances
                            </th>

                            <th class="px-4 py-3">
                                Late Deduction
                            </th>

                            <th class="px-4 py-3">
                                Net Pay
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        @foreach($payrollItems as $item)

                            <tr class="hover:bg-gray-50">

                                <!-- EMPLOYEE -->
                                <td class="px-4 py-3">

                                    <div class="font-semibold text-gray-800">
                                        {{ $item->employee->name }}
                                    </div>

                                    <div class="text-xs text-gray-500">
                                        {{ $item->employee->employee_code }}
                                    </div>

                                </td>

                                <!-- DAYS -->
                                <td class="px-4 py-3">
                                    {{ $item->days_present }}
                                </td>

                                <!-- REGULAR HOURS -->
                                <td class="px-4 py-3">
                                    {{ number_format($item->regular_hours, 2) }}
                                </td>

                                <!-- OT -->
                                <td class="px-4 py-3 text-orange-600 font-medium">
                                    {{ number_format($item->overtime_hours, 2) }}
                                </td>

                                <!-- BASIC -->
                                <td class="px-4 py-3">
                                    ₱{{ number_format($item->basic_pay, 2) }}
                                </td>

                                <!-- OT PAY -->
                                <td class="px-4 py-3 text-green-600 font-medium">
                                    ₱{{ number_format($item->overtime_pay, 2) }}
                                </td>

                                <!-- ALLOWANCES -->
                                <td class="px-4 py-3 text-blue-600 font-medium">
                                    ₱{{ number_format($item->allowances, 2) }}
                                </td>

                                <!-- LATE -->
                                <td class="px-4 py-3 text-red-500">
                                    ₱{{ number_format($item->late_deduction, 2) }}
                                </td>

                                <!-- NET -->
                                <td class="px-4 py-3 font-bold text-blue-600">
                                    ₱{{ number_format($item->net_pay, 2) }}
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    @endif

</div>