<table>

<tr>
    <td>
        PHILIPPINE SOCIETY OF ANESTHESIOLOGISTS, INC.
    </td>
</tr>

<tr>
    <td>
        PAYROLL FOR THE PERIOD
        {{ \Carbon\Carbon::parse($payroll->date_from)->format('F d, Y') }}
        -
        {{ \Carbon\Carbon::parse($payroll->date_to)->format('F d, Y') }}
    </td>
</tr>

<tr></tr>

<tr>

    <th>EMPLOYEE CODE</th>

    <th>EMPLOYEE NAME</th>

    <th>BASIC PAY</th>

    <th>OVERTIME PAY</th>

    @foreach($allowanceTypes as $allowance)

        <th>
            {{ strtoupper($allowance) }}
        </th>

    @endforeach

    <th>GROSS PAY</th>

    @foreach($deductionTypes as $deduction)

        <th>
            {{ strtoupper($deduction) }}
        </th>

    @endforeach

    <th>TAX</th>

    <th>OTHER DEDUCTIONS</th>

    <th>NET PAY</th>

</tr>

@foreach($items as $item)

    <tr>

        <td>
            {{ $item->employee->employee_code }}
        </td>

        <td>
            {{ strtoupper($item->employee->name) }}
        </td>

        <td>
            {{ $item->basic_pay }}
        </td>

        <td>
            {{ $item->overtime_pay }}
        </td>

        @foreach($allowanceTypes as $allowance)

            @php

                $allowanceAmount = optional(
                    $item->allowanceItems
                        ->where(
                            'allowance_name',
                            $allowance
                        )
                        ->first()
                )->amount;

            @endphp

            <td>
                {{ $allowanceAmount ?? 0 }}
            </td>

        @endforeach

        <td>
            {{ $item->gross_pay }}
        </td>

        @foreach($deductionTypes as $deduction)

            @php

                $deductionAmount = optional(
                    $item->deductionItems
                        ->where(
                            'deduction_name',
                            $deduction
                        )
                        ->first()
                )->amount;

            @endphp

            <td>
                {{ $deductionAmount ?? 0 }}
            </td>

        @endforeach

        <td>
            {{ $item->tax_deduction }}
        </td>

        <td>
            {{ $item->other_deductions }}
        </td>

        <td>
            {{ $item->net_pay }}
        </td>

    </tr>

@endforeach

<tr>

    <td></td>

    <td>
        TOTALS
    </td>

    <td></td>

    <td></td>

    @foreach($allowanceTypes as $allowance)

        <td></td>

    @endforeach

    <td></td>

    @foreach($deductionTypes as $deduction)

        <td></td>

    @endforeach

    <td></td>

    <td></td>

    <td></td>

</tr>

</table>
