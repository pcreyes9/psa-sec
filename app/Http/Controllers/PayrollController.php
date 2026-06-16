<?php

namespace App\Http\Controllers;

use App\Exports\PayrollExport;
use App\Models\PayrollItem;
use App\Models\Payroll;
use Maatwebsite\Excel\Facades\Excel;

class PayrollController extends Controller
{
    public function export($month, $cutoff)
    {
        $payrollCode =
            $month . '-C' . $cutoff;

        $items = PayrollItem::with([
            'employee',
            'allowanceItems',
            'deductionItems',
        ])
        ->where(
            'payroll_code',
            $payrollCode
        )
        ->get();

        $payroll = Payroll::where(
            'payroll_code',
            $payrollCode
        )->firstOrFail();

        return Excel::download(

            new PayrollExport(

                $items,

                $month,

                $cutoff,

                $payroll

            ),

            "Payroll-{$payroll->payroll_code}.xlsx"

        );
    }
}   