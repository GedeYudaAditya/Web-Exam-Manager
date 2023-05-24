<?php

namespace App\Exports;

use App\Models\Report;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LeaderboardExport implements FromCollection, WithHeadings, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = Report::select('test.name as Test Name', 'user.name as Username', 'reports.score', 'reports.created_at as Created At')
            ->join('users as user', 'user.id', '=', 'reports.user_id')
            ->join('tests as test', 'test.id', '=', 'reports.test_id')
            ->groupBy('test.id', 'test.name', 'user.name', 'reports.score', 'reports.created_at')
            ->orderBy('test.id', 'asc')
            ->orderBy('reports.score', 'desc')
            ->orderBy('user.name', 'asc')
            ->orderBy('reports.created_at', 'desc')
            // if user have tried the test more than once, only take the best score and hide the rest
            ->havingRaw('reports.score = max(reports.score)')
            ->get();

        $query->transform(function ($item) {
            $item->score = $item->score . '%';
            return $item;
        });

        return $query;
    }

    public function headings(): array
    {
        return [
            [
                'Universitas Pendidikan Ganesha',
            ],
            [
                'Laporan Hasil Test',
            ],
            [
                'Data Hasil Test',
            ],
            [
                'Test Name',
                'Username',
                'Score',
                'Created At',
            ]
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // for header
        $sheet->getStyle('A1:D1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 20
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ]);

        // for sub header
        $sheet->getStyle('A2:D2')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 16
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ]);

        // for sub header
        $sheet->getStyle('A3:D3')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ]);

        // merge cell
        $sheet->mergeCells('A1:D1');
        $sheet->mergeCells('A2:D2');
        $sheet->mergeCells('A3:D3');

        $sheet->getStyle('A4:D4')->applyFromArray([
            'font' => [
                'bold' => true
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => [
                    // grey
                    'rgb' => 'D3D3D3'
                ]
            ],
        ]);

        $sheet->getStyle('A5:B' . $sheet->getHighestRow())->applyFromArray([
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ]);

        // for all rows bordered
        $sheet->getStyle('A4:D' . $sheet->getHighestRow())
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        // give fill color to datas from user that have tried the test more than once and only take the best score
        foreach (range(5, $sheet->getHighestRow()) as $rowID) {
            $score = $sheet->getCell('C' . $rowID)->getValue();
            if ($score == '100%') {
                $sheet->getStyle('C' . $rowID)->applyFromArray([
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => [
                            // green
                            'rgb' => '00B050'
                        ]
                    ],
                ]);
            } else if ($score >= '80%') {
                $sheet->getStyle('C' . $rowID)->applyFromArray([
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => [
                            // yellow
                            'rgb' => 'FFFF00'
                        ]
                    ],
                ]);
            } else if ($score >= '60%') {
                $sheet->getStyle('C' . $rowID)->applyFromArray([
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => [
                            // orange
                            'rgb' => 'FFC000'
                        ]
                    ],
                ]);
            } else {
                $sheet->getStyle('C' . $rowID)->applyFromArray([
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => [
                            // red
                            'rgb' => 'FF0000'
                        ]
                    ],
                ]);
            }
        }

        // data with the same user will be merged but only if the test is not different
        // search the range of the same user
        // $startPoint = 5;
        // $endPoint = 5;

        // foreach (range(5, $sheet->getHighestRow()) as $rowID) {
        //     $testName = $sheet->getCell('A' . $rowID)->getValue();
        //     $nextTestName = $sheet->getCell('A' . ($rowID + 1))->getValue();
        //     $username = $sheet->getCell('B' . $rowID)->getValue();
        //     $nextUsername = $sheet->getCell('B' . ($rowID + 1))->getValue();

        //     if ($testName == $nextTestName && $username == $nextUsername) {
        //         $endPoint++;
        //     } else {
        //         $sheet->mergeCells('B' . $startPoint . ':B' . $endPoint);
        //         $startPoint = $rowID + 1;
        //         $endPoint = $rowID + 1;
        //     }
        // }

        // // data with the same test will be merged
        // // search the range of the same test
        // $startPoint = 5;
        // $endPoint = 5;

        // foreach (range(5, $sheet->getHighestRow()) as $rowID) {
        //     $testName = $sheet->getCell('A' . $rowID)->getValue();
        //     $nextTestName = $sheet->getCell('A' . ($rowID + 1))->getValue();

        //     if ($testName == $nextTestName) {
        //         $endPoint++;
        //     } else {
        //         $sheet->mergeCells('A' . $startPoint . ':A' . $endPoint);
        //         $startPoint = $rowID + 1;
        //         $endPoint = $rowID + 1;
        //     }
        // }

        // for all width column same with content
        foreach (range('A', 'D') as $columnID) {
            $sheet->getColumnDimension($columnID)
                ->setAutoSize(true);
        }
    }

    public function backgroundColor()
    {
        return new Color(Color::COLOR_BLUE);
    }
}
