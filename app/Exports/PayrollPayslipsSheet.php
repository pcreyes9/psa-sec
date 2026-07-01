<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class PayrollPayslipsSheet implements
    FromView,
    WithTitle,
    WithEvents
{
    protected $items;

    protected $payroll;

    public function __construct(
        $items,
        $payroll
    ) {
        $this->items = $items;

        $this->payroll = $payroll;
    }

    public function title(): string
    {
        return 'Payslips';
    }

    public function view(): View
    {
        return view(
            'exports.payroll-payslips',
            [
                'items' => $this->items,
                'payroll' => $this->payroll,
            ]
        );
    }

   public function registerEvents(): array
    {
    return [

    
        AfterSheet::class => function (
            AfterSheet $event
        ) {

            $sheet =
                $event->sheet
                    ->getDelegate();

            $highestRow =
                $sheet->getHighestRow();

            /*
            |--------------------------------------------------------------------------
            | Auto Width
            |--------------------------------------------------------------------------
            */

            foreach (
                range('A', 'D')
                as $column
            ) {

                $sheet
                    ->getColumnDimension(
                        $column
                    )
                    ->setAutoSize(
                        true
                    );

            }

            /*
            |--------------------------------------------------------------------------
            | Borders
            |--------------------------------------------------------------------------
            */

            $sheet->getStyle(
                "A1:D{$highestRow}"
            )->applyFromArray([

                'borders' => [

                    'allBorders' => [

                        'borderStyle' =>
                            Border::BORDER_THIN,

                    ],

                ],

            ]);

            /*
            |--------------------------------------------------------------------------
            | Currency Format
            |--------------------------------------------------------------------------
            */

            $sheet->getStyle(
                "B1:D{$highestRow}"
            )
            ->getNumberFormat()
            ->setFormatCode(
                '#,##0.00'
            );

            /*
            |--------------------------------------------------------------------------
            | Style Rows
            |--------------------------------------------------------------------------
            */

            for (
                $row = 1;
                $row <= $highestRow;
                $row++
            ) {

                $value =
                    trim(
                        (string)
                        $sheet
                            ->getCell(
                                "A{$row}"
                            )
                            ->getValue()
                    );

                /*
                |--------------------------------------------------------------------------
                | Company Header
                |--------------------------------------------------------------------------
                */

                if (
                    $value ===
                    'PHILIPPINE SOCIETY OF ANESTHESIOLOGISTS, INC.'
                ) {

                    $sheet->mergeCells(
                        "A{$row}:D{$row}"
                    );

                    $sheet->getStyle(
                        "A{$row}:D{$row}"
                    )->applyFromArray([

                        'font' => [

                            'bold' => true,

                            'size' => 16,

                            'color' => [
                                'rgb' => 'FFFFFF',
                            ],

                        ],

                        'alignment' => [

                            'horizontal' =>
                                Alignment::HORIZONTAL_CENTER,

                        ],

                        'fill' => [

                            'fillType' =>
                                Fill::FILL_SOLID,

                            'startColor' => [
                                'rgb' => '1E40AF',
                            ],

                        ],

                    ]);

                }

                /*
                |--------------------------------------------------------------------------
                | Payslip Title
                |--------------------------------------------------------------------------
                */

                if (
                    $value ===
                    'EMPLOYEE PAYSLIP'
                ) {

                    $sheet->mergeCells(
                        "A{$row}:D{$row}"
                    );

                    $sheet->getStyle(
                        "A{$row}:D{$row}"
                    )->applyFromArray([

                        'font' => [

                            'bold' => true,

                            'size' => 12,

                        ],

                        'alignment' => [

                            'horizontal' =>
                                Alignment::HORIZONTAL_CENTER,

                        ],

                    ]);

                }

                /*
                |--------------------------------------------------------------------------
                | Pay Period
                |--------------------------------------------------------------------------
                */

                if (
                    str_contains(
                        $value,
                        'PAY PERIOD:'
                    )
                ) {

                    $sheet->mergeCells(
                        "A{$row}:D{$row}"
                    );

                    $sheet->getStyle(
                        "A{$row}:D{$row}"
                    )->applyFromArray([

                        'font' => [

                            'italic' => true,

                        ],

                        'alignment' => [

                            'horizontal' =>
                                Alignment::HORIZONTAL_CENTER,

                        ],

                    ]);

                }

                /*
                |--------------------------------------------------------------------------
                | Section Header
                |--------------------------------------------------------------------------
                */

                if (
                    $value ===
                    'EARNINGS'
                ) {

                    $sheet->getStyle(
                        "A{$row}:D{$row}"
                    )->applyFromArray([

                        'font' => [

                            'bold' => true,

                            'color' => [
                                'rgb' => 'FFFFFF',
                            ],

                        ],

                        'fill' => [

                            'fillType' =>
                                Fill::FILL_SOLID,

                            'startColor' => [
                                'rgb' => '2563EB',
                            ],

                        ],

                    ]);

                }

                /*
                |--------------------------------------------------------------------------
                | Employee Labels
                |--------------------------------------------------------------------------
                */

                if (
                    in_array(
                        $value,
                        [

                            'Employee Name',

                            'Employee Code',

                            'Payroll Code',

                        ]
                    )
                ) {

                    $sheet->getStyle(
                        "A{$row}"
                    )->getFont()
                        ->setBold(
                            true
                        );

                }

                /*
                |--------------------------------------------------------------------------
                | Total Allowances
                |--------------------------------------------------------------------------
                */

                if (
                    $value ===
                    'Total Allowances'
                ) {

                    $sheet->getStyle(
                        "A{$row}:D{$row}"
                    )->applyFromArray([

                        'font' => [

                            'bold' => true,

                        ],

                        'fill' => [

                            'fillType' =>
                                Fill::FILL_SOLID,

                            'startColor' => [
                                'rgb' => 'DBEAFE',
                            ],

                        ],

                    ]);

                }

                /*
                |--------------------------------------------------------------------------
                | Gross Pay
                |--------------------------------------------------------------------------
                */

                if (
                    $value ===
                    'Gross Pay'
                ) {

                    $sheet->getStyle(
                        "A{$row}:D{$row}"
                    )->applyFromArray([

                        'font' => [

                            'bold' => true,

                        ],

                        'fill' => [

                            'fillType' =>
                                Fill::FILL_SOLID,

                            'startColor' => [
                                'rgb' => 'BFDBFE',
                            ],

                        ],

                    ]);

                }

                /*
                |--------------------------------------------------------------------------
                | Total Deductions
                |--------------------------------------------------------------------------
                */

                if (
                    $value ===
                    'Total Deductions'
                ) {

                    $sheet->getStyle(
                        "C{$row}:D{$row}"
                    )->applyFromArray([

                        'font' => [

                            'bold' => true,

                        ],

                        'fill' => [

                            'fillType' =>
                                Fill::FILL_SOLID,

                            'startColor' => [
                                'rgb' => 'FEE2E2',
                            ],

                        ],

                    ]);

                }

                /*
                |--------------------------------------------------------------------------
                | Net Pay
                |--------------------------------------------------------------------------
                */

                if (
                    $value ===
                    'NET PAY'
                ) {

                    $sheet->getStyle(
                        "A{$row}:D{$row}"
                    )->applyFromArray([

                        'font' => [

                            'bold' => true,

                            'size' => 14,

                            'color' => [
                                'rgb' => '166534',
                            ],

                        ],

                        'fill' => [

                            'fillType' =>
                                Fill::FILL_SOLID,

                            'startColor' => [
                                'rgb' => 'DCFCE7',
                            ],

                        ],

                    ]);

                }

            }

        },

    ];
    

    }

}
