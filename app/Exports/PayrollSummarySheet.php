<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Alignment;


class PayrollSummarySheet implements FromView, WithEvents, WithTitle, WithMultipleSheets{
    protected $items;
    protected $month;
    protected $cutoff;
    protected $allowanceTypes = [];
     protected $deductionTypes = [];

    public function __construct(
        $items,
        $month,
        $cutoff,
        $payroll
    ) {
        $this->items = $items;

        $this->month = $month;

        $this->cutoff = $cutoff;

        $this->payroll = $payroll;
    }
    public function title(): string
    {
        return 'Summary';
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

            $highestColumn =
                $sheet->getHighestColumn();

            foreach (
                range('A', $highestColumn)
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
                
                $sheet =
                    $event->sheet
                        ->getDelegate();

                $highestColumn =
                    $sheet->getHighestColumn();

                $highestRow =
                    $sheet->getHighestRow();

                $highestColumnIndex =
                    \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString(
                        $highestColumn
                    );

                /*
                |--------------------------------------------------------------------------
                | Layout
                |--------------------------------------------------------------------------
                |
                | Row 1 : Company Name
                | Row 2 : Payroll Period
                | Row 3 : Blank
                | Row 4 : Headers
                | Row 5+ : Employees
                | Last Row : Totals
                |
                */

                $dataStartRow = 5;

                $totalsRow =
                    $highestRow;

                $dataEndRow =
                    $totalsRow - 1;

                /*
                |--------------------------------------------------------------------------
                | Header Styling
                |--------------------------------------------------------------------------
                */

                $sheet->getStyle(
                    "A4:{$highestColumn}4"
                )->getFont()->setBold(true);

                /*
                |--------------------------------------------------------------------------
                | Company Name
                |--------------------------------------------------------------------------
                */

                $sheet->mergeCells(
                    "A1:{$highestColumn}1"
                );

                $sheet->getStyle(
                    'A1'
                )->getFont()
                    ->setBold(true)
                    ->setSize(16);

                $sheet->mergeCells(
                    "A2:{$highestColumn}2"
                );

                $sheet->getStyle(
                    'A2'
                )->getFont()
                    ->setBold(true);

                /*
                |--------------------------------------------------------------------------
                | Totals Row Formulas
                |--------------------------------------------------------------------------
                */

                $sheet->setCellValue(
                    'B' . $totalsRow,
                    'TOTALS'
                );

                for (
                    $column = 3;
                    $column <= $highestColumnIndex;
                    $column++
                ) {

                    $columnLetter =
                        \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(
                            $column
                        );

                    if ($dataEndRow >= $dataStartRow) {

                        $sheet->setCellValueExplicit(
                            $columnLetter . $totalsRow,
                            "=SUM({$columnLetter}{$dataStartRow}:{$columnLetter}{$dataEndRow})",
                            \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_FORMULA
                        );

                    }
                }

                /*
                |--------------------------------------------------------------------------
                | Totals Row Styling
                |--------------------------------------------------------------------------
                */

                $sheet->getStyle(
                    "A{$totalsRow}:{$highestColumn}{$totalsRow}"
                )->getFont()->setBold(true);

                /*
                |--------------------------------------------------------------------------
                | Borders
                |--------------------------------------------------------------------------
                */

                $sheet->getStyle(
                    "A4:{$highestColumn}{$totalsRow}"
                )->applyFromArray([

                    'borders' => [

                        'allBorders' => [

                            'borderStyle' =>
                                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,

                        ],

                    ],

                ]);

                /*
                |--------------------------------------------------------------------------
                | Number Formatting
                |--------------------------------------------------------------------------
                */

                $sheet->getStyle(
                    "C5:{$highestColumn}{$totalsRow}"
                )
                ->getNumberFormat()
                ->setFormatCode(
                    '#,##0.00'
                );
                $sheet->getStyle(
                    "A{$totalsRow}:{$highestColumn}{$totalsRow}"
                )->applyFromArray([

                    'font' => [
                        'bold' => true,
                        'color' => [
                            'rgb' => '000',
                        ],
                    ],

                    'fill' => [
                        'fillType' =>
                            \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,

                        'startColor' => [
                            'rgb' => '70AD47',
                        ],
                    ],

                ]);

                /*
                |--------------------------------------------------------------------------
                | Freeze Header
                |--------------------------------------------------------------------------
                */

                $sheet->freezePane('A5');

                /*
                |--------------------------------------------------------------------------
                | Landscape
                |--------------------------------------------------------------------------
                */

                $sheet->getPageSetup()
                    ->setOrientation(
                        \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE
                    );

                $sheet->getPageSetup()
                    ->setFitToWidth(1);

                $sheet->mergeCells(
                    "A1:{$highestColumn}1"
                );

                $sheet->mergeCells(
                    "A2:{$highestColumn}2"
                );
                

            },

        ];
    }

    public function sheets(): array
    {
        return [

            new PayrollSummarySheet(

                $this->items,

                $this->month,

                $this->cutoff,

                $this->payroll

            ),

            new PayrollPayslipsSheet(

                $this->items,

                $this->payroll

            ),

        ];
    }

    public function view(): View
    {
        // dd($this->items);
        // dd($this->items->first());
        $allowanceTypes = $this->items
            ->flatMap(
                fn ($item) => $item->allowanceItems
            )
            ->pluck('allowance_name')
            ->unique()
            ->values();

        $deductionTypes = $this->items
            ->flatMap(
                fn ($item) => $item->deductionItems
            )
            ->pluck('deduction_name')
            ->unique()
            ->values();

                
        // dd($allowanceTypes);

        return view(
            'exports.payroll',
            [
                'items' => $this->items,
                'payroll' => $this->payroll,
                'month' => $this->month,
                'cutoff' => $this->cutoff,
                'allowanceTypes' => $allowanceTypes,
                'deductionTypes' => $deductionTypes,
            ]
        );
    }
}