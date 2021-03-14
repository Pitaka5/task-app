<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class TaskExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($list)
    {
        $this->list = $list;
    }

    public function map($item): array
    {
        return [
            $item->title,
            $item->date,
            $item->time_spent,
            $item->comment,
        ];
    }

    public function collection()
    {
        return $this->list;
    }

    public function headings() :array
    {
        return [
            __('Title'),
            __('Date'),
            __('Time spent'),
            __('Comment'),
        ];
    }

    public function registerEvents(): array
    {
        return [
             AfterSheet::class => function(AfterSheet $event) {

                $endLine = count($this->list) + 2;

                $event->sheet->styleCells(
                    'A1:E'.$endLine,
                    [
                        'alignment' => [
                            'horizontal' => Alignment::HORIZONTAL_LEFT,
                        ],
                    ]
                );

                $event->sheet->styleCells(
                    'A1:E1',
                    [
                        'font' => [
                            'bold' => true,
                        ],
                    ]
                );

                $event->sheet->setCellValue('B'.$endLine, __('Total'));
                $event->sheet->setCellValue('C'.$endLine, $this->list->sum('time_spent'));
            },
        ];
    }
}
