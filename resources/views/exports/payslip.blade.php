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

<tr>
    <td>Pay Period</td>
    <td>
        {{ \Carbon\Carbon::parse($item->payroll->date_from)->format('M d, Y') }}
        -
        {{ \Carbon\Carbon::parse($item->payroll->date_to)->format('M d, Y') }}
    </td>
</tr>

<tr></tr>

<tr>
    <th>EARNINGS</th>
    <th>AMOUNT</th>
</tr>

<tr>
    <td>Basic Pay</td>
    <td>{{ $item->basic_pay }}</td>
</tr>

<tr>
    <td>Overtime Pay</td>
    <td>{{ $item->overtime_pay }}</td>
</tr>

@foreach($item->allowanceItems as $allowance)

    <tr>

        <td>
            {{ $allowance->allowance_name }}
        </td>

        <td>
            {{ $allowance->amount }}
        </td>

    </tr>

@endforeach

<tr>

    <td>
        Total Allowances
    </td>

    <td>
        {{ $item->allowanceItems->sum('amount') }}
    </td>

</tr>

<tr>

    <td>
        Gross Pay
    </td>

    <td>
        {{ $item->gross_pay }}
    </td>

</tr>

<tr></tr>

<tr>
    <th>DEDUCTIONS</th>
    <th>AMOUNT</th>
</tr>

@foreach($item->deductionItems as $deduction)

    <tr>

        <td>
            {{ $deduction->deduction_name }}
        </td>

        <td>
            {{ $deduction->amount }}
        </td>

    </tr>

@endforeach

<tr>

    <td>
        Tax
    </td>

    <td>
        {{ $item->tax_deduction }}
    </td>

</tr>

<tr>

    <td>
        Other Deductions
    </td>

    <td>
        {{ $item->other_deductions }}
    </td>

</tr>

<tr>

    <td>
        Total Deductions
    </td>

    <td>

        {{
            $item->deductionItems->sum('amount')
            + $item->tax_deduction
            + $item->other_deductions
        }}

    </td>

</tr>

<tr></tr>

<tr>

    <td>
        NET PAY
    </td>

    <td>
        {{ $item->net_pay }}
    </td>

</tr>


</table>
