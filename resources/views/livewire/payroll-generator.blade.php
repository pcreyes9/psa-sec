<div class="space-y-6">

    <x-flash-message />

    <div class="bg-white rounded-3xl border p-6">

        <div class="flex items-center justify-between">

            <h2 class="text-2xl font-bold">
                Payroll Generator
            </h2>

            <div class="flex gap-2">

                <button
                    wire:click="generatePayroll"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-xl">

                    Generate Payroll

                </button>

                @if($payrollExists)

                    <a
                        href="{{ route('payroll.export', [
                            'month' => $month,
                            'cutoff' => $cutoff
                        ]) }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl">

                        Export Excel

                    </a>

                @endif

            </div>

        </div>

        <div class="grid md:grid-cols-2 gap-4 mt-6">

            <div>

                <label class="text-sm text-gray-500">
                    Month
                </label>

                <input
                    type="month"
                    wire:model.live="month"
                    class="w-full rounded-xl border-gray-300">

            </div>

            <div>

                <label class="text-sm text-gray-500">
                    Cutoff
                </label>

                <select
                    wire:model.live="cutoff"
                    class="w-full rounded-xl border-gray-300">

                    <option value="1">
                        1st Cutoff (1-15)
                    </option>

                    <option value="2">
                        2nd Cutoff (16-End)
                    </option>

                </select>

            </div>

        </div>

    </div>

    <div class="bg-white rounded-3xl border overflow-hidden">

        <div class="px-6 py-4 border-b">

            <h3 class="font-bold text-lg">
                Payroll Items
            </h3>

        </div>

        <table class="w-full text-sm">

            <thead class="bg-gray-50">

                <tr>

                    <th class="p-4 text-left">
                        Employee
                    </th>

                    <th class="p-4 text-right">
                        Basic Salary (half month)
                    </th>

                    <th class="p-4 text-right">
                        Total Overtime
                    </th>

                    <th class="p-4 text-right">
                        Total Allowance
                    </th>

                    <th class="p-4 text-right">
                        Deductions
                    </th>

                     <th class="p-4 text-right">
                        Tax
                    </th>

                    <th class="p-4 text-right">
                        Gross Pay
                    </th>

                    <th class="p-4 text-right">
                        Net Pay
                    </th>

                    {{-- <th class="p-4 text-center">
                        Status
                    </th> --}}

                </tr>

            </thead>

            <tbody>

                @forelse($payrollItems as $item)

                    <tr class="border-t">

                        <td class="p-4">
                            <div class="font-medium text-gray-800">
                                {{ $item->employee->name }}
                            </div>

                            <div class="text-xs text-gray-500">
                                {{ $item->employee->employee_code }}
                            </div>
                        </td>

                        <td class="p-4 text-right">
                            ₱{{ number_format(
                                $item->basic_pay,
                                2
                            ) }}
                        </td>

                        {{-- overtime --}}
                        <td class="p-4 text-right">
                            ₱{{ number_format(
                                $item->overtime_pay,
                                2
                            ) }}
                        </td>

                        {{-- allowances --}}
                        <td class="p-4 text-right">
                            ₱{{ number_format(
                                $item->allowances,
                                2
                            ) }}
                        </td>

                        {{-- deductions --}}
                        <td class="p-4 text-right">
                            ₱{{ number_format(
                                $item->other_deductions,
                                2
                            ) }}
                        </td>

                        <td class="p-4 text-right">
                            ₱{{ number_format(
                                $item->tax_deduction,
                                2
                            ) }}
                        </td>

                        <td class="p-4 text-right">
                            ₱{{ number_format(
                                $item->gross_pay,
                                2
                            ) }}
                        </td>

                        <td class="p-4 text-right font-bold text-green-600">
                            ₱{{ number_format(
                                $item->net_pay,
                                2
                            ) }}
                        </td>

                        {{-- <td class="p-4 text-center">

                            <span class="px-3 py-1 rounded-full text-xs bg-yellow-100 text-yellow-700">

                                {{ $item->status }}

                            </span>

                        </td> --}}

                    </tr>

                @empty
                    <tr>
                        <td
                            colspan="4"
                            class="p-10 text-center text-gray-500">

                            No payroll items found.
                        </td>
                    </tr>
                @endforelse
            </tbody>

            {{-- <tfoot class="bg-gray-50 border-t">

                <tr>

                    <td class="p-4 font-bold">
                        Total
                    </td>

                    <td></td>

                    <td class="p-4 text-right font-bold text-xl text-green-600">

                        ₱{{ number_format(
                            collect($payrollItems)->sum('net_pay'),
                            2
                        ) }}

                    </td>

                    <td></td>

                </tr>

            </tfoot> --}}

        </table>

    </div>

</div>