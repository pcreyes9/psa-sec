<?php

namespace App\Exports;

use App\Models\PayrollItem;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

class PayslipExport implements FromView, WithEvents
{
    protected PayrollItem $item;

    public function __construct(
        PayrollItem $item
    ) {
        $this->item = $item;
    }

    public function view(): View
    {
        $this->item->load([

            'employee',

            'payroll',

            'allowanceItems',

            'deductionItems',

        ]);

        return view(
            'exports.payslip',
            [
                'item' => $this->item,
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

                $highestColumn =
                    $sheet->getHighestColumn();

                /*
                |--------------------------------------------------------------------------
                | Auto Width
                |--------------------------------------------------------------------------
                */

                foreach (
                    range(
                        'A',
                        $highestColumn
                    ) as $column
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
                | Header
                |--------------------------------------------------------------------------
                */

                $sheet->mergeCells(
                    'A1:B1'
                );

                $sheet->mergeCells(
                    'A2:B2'
                );

                $sheet->getStyle(
                    'A1:B2'
                )->getFont()
                    ->setBold(true);

                $sheet->getStyle(
                    'A1'
                )->getFont()
                    ->setSize(16);

                /*
                |--------------------------------------------------------------------------
                | Earnings Header
                |--------------------------------------------------------------------------
                */

                $sheet->getStyle(
                    'A10:B10'
                )->getFont()
                    ->setBold(true);

                /*
                |--------------------------------------------------------------------------
                | Deductions Header
                |--------------------------------------------------------------------------
                */

                $sheet->getStyle(
                    'A20:B20'
                )->getFont()
                    ->setBold(true);

                /*
                |--------------------------------------------------------------------------
                | Borders
                |--------------------------------------------------------------------------
                */

                $sheet->getStyle(
                    "A1:B{$highestRow}"
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
                | Currency Formatting
                |--------------------------------------------------------------------------
                */

                $sheet->getStyle(
                    "B1:B{$highestRow}"
                )
                ->getNumberFormat()
                ->setFormatCode(
                    '#,##0.00'
                );

            },

        ];
    }
}
