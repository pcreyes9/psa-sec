<!DOCTYPE html>

<html>
    <head>

        <meta charset="utf-8">

        <title>
            {{ $item->employee->name }}: Payslip {{ \Carbon\Carbon::parse($item->payroll->date_from)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($item->payroll->date_to)->format('M d, Y') }}
        </title>

        <style>

            body {
                font-family: DejaVu Sans, sans-serif;
                font-size: 11px;
                color: #374151;
                margin: 25px;
            }

            .header {
                border-bottom: 3px solid #1E40AF;
                padding-bottom: 12px;
                margin-bottom: 20px;
            }

            .company {
                font-size: 22px;
                font-weight: bold;
                color: #1E3A8A;
            }

            .title {
                font-size: 13px;
                color: #6B7280;
                margin-top: 5px;
            }

            .card {
                border: 1px solid #D1D5DB;
                border-radius: 6px;
                padding: 12px;
                margin-bottom: 15px;
            }

            .section-title {
                font-size: 13px;
                font-weight: bold;
                color: #111827;
                margin-bottom: 8px;
            }

            .info-table {
                width: 100%;
                border-collapse: collapse;
            }

            .info-table td {
                padding: 4px;
            }

            .label {
                font-weight: bold;
                color: #111827;
                width: 120px;
            }

            .table {
                width: 100%;
                border-collapse: collapse;
            }

            .table th {
                background: #1E40AF;
                color: white;
                padding: 8px;
                text-align: left;
            }

            .table td {
                border: 1px solid #E5E7EB;
                padding: 6px;
            }

            .amount {
                text-align: right;
            }

            .summary {
                margin-top: 15px;
                width: 100%;
            }

            .summary td {
                padding: 12px;
                text-align: center;
            }

            .gross-box {
                background: #DBEAFE;
                border: 1px solid #93C5FD;
            }

            .deduction-box {
                background: #FEE2E2;
                border: 1px solid #FCA5A5;
            }

            .net-box {
                background: #DCFCE7;
                border: 2px solid #22C55E;
            }

            .summary-label {
                font-size: 11px;
                font-weight: bold;
            }

            .summary-value {
                margin-top: 5px;
                font-size: 18px;
                font-weight: bold;
            }

            .footer {
                margin-top: 25px;
                font-size: 10px;
                color: #6B7280;
                text-align: center;
            }

        </style>


    </head>
    <body>
        @php

            $totalAllowances =
                $item->allowanceItems->sum('amount');

            $totalDeductions =
                $item->deductionItems->sum('amount')
                + $item->tax_deduction
                + $item->other_deductions;

        @endphp

        <div class="header">
            <div class="company">
                PHILIPPINE SOCIETY OF ANESTHESIOLOGISTS, INC.
            </div>

            <div class="title">
                EMPLOYEE PAYSLIP
            </div>
        </div>

        <div class="card">
            <div class="section-title">
                Employee Information
            </div>

            <table class="info-table">
                <tr>

                    <td class="label">
                        Employee Name
                    </td>

                    <td>
                        {{ $item->employee->name }}
                    </td>

                    <td class="label">
                        Employee Code
                    </td>

                    <td>
                        {{ $item->employee->employee_code }}
                    </td>

                </tr>

                <tr>

                    <td class="label">
                        Payroll Code
                    </td>

                    <td>
                        {{ $item->payroll->payroll_code }}
                    </td>

                    <td class="label">
                        Pay Period
                    </td>

                    <td>

                        {{ \Carbon\Carbon::parse($item->payroll->date_from)->format('M d, Y') }}

                        -

                        {{ \Carbon\Carbon::parse($item->payroll->date_to)->format('M d, Y') }}

                    </td>

                </tr>

                <tr>

                    <td class="label">
                        Generated On
                    </td>

                    <td>
                        {{ now()->format('M d, Y h:i A') }}
                    </td>

                    {{-- <td class="label">
                        Status
                    </td>

                    <td>
                        {{ $item->status }}
                    </td> --}}

                </tr>
            </table>
        </div>

        {{-- <div class="card">

            <div class="section-title">
                Attendance Summary
            </div>

            <table class="info-table">

                <tr>

                    <td class="label">
                        Days Present
                    </td>

                    <td>
                        {{ $item->days_present ?? '-' }}
                    </td>

                    <td class="label">
                        Regular Hours
                    </td>

                    <td>
                        {{ $item->regular_hours ?? '-' }}
                    </td>

                </tr>

                <tr>

                    <td class="label">
                        Overtime Hours
                    </td>

                    <td>
                        {{ $item->overtime_hours ?? '-' }}
                    </td>

                    <td class="label">
                        Hourly Rate
                    </td>

                    <td>
                        ₱ {{ number_format($item->hourly_rate, 2) }}
                    </td>

                </tr>

            </table>

        </div> --}}

        <table class="table">
            <tr>

                <th width="50%">
                    EARNINGS
                </th>

                <th width="50%">
                    DEDUCTIONS
                </th>

            </tr>

            <tr>
                <td valign="top">
                    <table width="100%">

                        <tr>

                            <td>
                                Basic Pay
                            </td>

                            <td class="amount">
                                {{ number_format($item->basic_pay, 2) }}
                            </td>

                        </tr>

                        <tr>

                            <td>
                                Overtime Pay
                            </td>

                            <td class="amount">
                                {{ number_format($item->overtime_pay, 2) }}
                            </td>

                        </tr>

                        @foreach($item->allowanceItems as $allowance)

                            <tr>

                                <td>
                                    {{ $allowance->allowance_name }}
                                </td>

                                <td class="amount">
                                    {{ number_format($allowance->amount, 2) }}
                                </td>

                            </tr>

                        @endforeach

                        <tr>

                            <td>
                                <strong>Total Allowances</strong>
                            </td>

                            <td class="amount">
                                <strong>
                                    {{ number_format($totalAllowances, 2) }}
                                </strong>
                            </td>

                        </tr>

                    </table>
                </td>

                <td valign="top">
                    <table width="100%">

                        @foreach($item->deductionItems as $deduction)

                            <tr>

                                <td>
                                    {{ $deduction->deduction_name }}
                                </td>

                                <td class="amount">
                                    {{ number_format($deduction->amount, 2) }}
                                </td>

                            </tr>

                        @endforeach

                        <tr>

                            <td>
                                Tax
                            </td>

                            <td class="amount">
                                {{ number_format($item->tax_deduction, 2) }}
                            </td>

                        </tr>

                        <tr>

                            <td>
                                Other Deductions
                            </td>

                            <td class="amount">
                                {{ number_format($item->other_deductions, 2) }}
                            </td>

                        </tr>

                        <tr>

                            <td>
                                <strong>Total Deductions</strong>
                            </td>

                            <td class="amount">
                                <strong>
                                    {{ number_format($totalDeductions, 2) }}
                                </strong>
                            </td>

                        </tr>

                    </table>
                </td>
            </tr>
        </table>

        <table class="summary">
            <tr>
                <td class="gross-box">

                    <div class="summary-label">
                        GROSS PAY
                    </div>

                    <div class="summary-value">
                        ₱ {{ number_format($item->gross_pay, 2) }}
                    </div>

                </td>

                <td class="deduction-box">

                    <div class="summary-label">
                        TOTAL DEDUCTIONS
                    </div>

                    <div class="summary-value">
                        ₱ {{ number_format($totalDeductions, 2) }}
                    </div>

                </td>

                <td class="net-box">

                    <div class="summary-label">
                        NET PAY
                    </div>

                    <div class="summary-value">
                        ₱ {{ number_format($item->net_pay, 2) }}
                    </div>

                </td>
            </tr>
        </table>

        <div class="footer">

            This document is system-generated by the PSA Secretariat Payroll System and does not require a physical signature.

        </div>
    </body>
</html>
