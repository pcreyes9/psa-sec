@foreach($items as $item)
    @php

        $totalAllowances =
            $item->allowanceItems->sum('amount');

        $totalDeductions =
            $item->deductionItems->sum('amount')
            + $item->tax_deduction
            + $item->other_deductions;

    @endphp

    <table>

        <tr>
            <td>
                PHILIPPINE SOCIETY OF ANESTHESIOLOGISTS, INC.
            </td>
        </tr>

        <tr>
            <td>
                EMPLOYEE PAYSLIP
            </td>
        </tr>

        <tr>
            <td>
                PAY PERIOD:
                {{ \Carbon\Carbon::parse($payroll->date_from)->format('M d, Y') }}
                -
                {{ \Carbon\Carbon::parse($payroll->date_to)->format('M d, Y') }}
            </td>
        </tr>

        <tr></tr>

        <tr>
            <td>Employee Name</td>
            <td>{{ $item->employee->name }}</td>
        </tr>

        <tr>
            <td>Employee Code</td>
            <td>{{ $item->employee->employee_code }}</td>
        </tr>

        <tr>
            <td>Payroll Code</td>
            <td>{{ $item->payroll->payroll_code }}</td>
        </tr>

        <tr></tr>

        <tr>
            <th>EARNINGS</th>
            <th>AMOUNT</th>

            <th>DEDUCTIONS</th>
            <th>AMOUNT</th>
        </tr>

        <tr>
            <td>Basic Pay</td>
            <td>{{ $item->basic_pay }}</td>

            <td>Tax</td>
            <td>{{ $item->tax_deduction }}</td>
        </tr>

        <tr>
            <td>Overtime Pay</td>
            <td>{{ $item->overtime_pay }}</td>

            <td>Other Deductions</td>
            <td>{{ $item->other_deductions }}</td>
        </tr>

        @php

            $maxRows = max(
                $item->allowanceItems->count(),
                $item->deductionItems->count()
            );

        @endphp

        @for($i = 0; $i < $maxRows; $i++)

            <tr>

                <td>
                    {{ $item->allowanceItems[$i]->allowance_name ?? '' }}
                </td>

                <td>
                    {{ $item->allowanceItems[$i]->amount ?? '' }}
                </td>

                <td>
                    {{ $item->deductionItems[$i]->deduction_name ?? '' }}
                </td>

                <td>
                    {{ $item->deductionItems[$i]->amount ?? '' }}
                </td>

            </tr>

        @endfor

        <tr>

            <td>
                Total Allowances
            </td>

            <td>
                {{ $totalAllowances }}
            </td>

            <td>
                Total Deductions
            </td>

            <td>
                {{ $totalDeductions }}
            </td>

        </tr>

        <tr></tr>

        <tr>

            <td>
                Gross Pay
            </td>

            <td></td>

            <td></td>

            <td>
                {{ $item->gross_pay }}
            </td>

        </tr>

        <tr>

            <td>
                NET PAY
            </td>

            <td></td>

            <td></td>

            <td>
                {{ $item->net_pay }}
            </td>

        </tr>

    </table>

    <table>

        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>

    </table>
@endforeach
