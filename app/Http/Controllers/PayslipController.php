<?php

namespace App\Http\Controllers;

use App\Exports\PayslipExport;
use App\Models\PayrollItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class PayslipController extends Controller
{
    public function show(
        PayrollItem $payrollItem
    )
    {
        $payrollItem->load([

            'employee',

            'payroll',

            'allowanceItems',

            'deductionItems',

        ]);

        $pdf = Pdf::loadView(
            'pdf.payslip',
            [
                'item' => $payrollItem,
            ]
        );

        return $pdf->stream(
            $payrollItem->employee->employee_code .
            '-Payslip.pdf'
        );
    }

    public function excel(
        PayrollItem $payrollItem
    )
    {
        return Excel::download(

            new PayslipExport(
                $payrollItem
            ),

            $payrollItem->employee->employee_code .
            '-Payslip.xlsx'

        );
    }
}
