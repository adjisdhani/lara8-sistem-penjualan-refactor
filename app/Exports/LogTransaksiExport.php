<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LogTransaksiExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $data;
    protected $columns;
    protected $rowIndex = 0;

    public function __construct($data, $columns)
    {
        $this->data    = $data;
        $this->columns = $columns;
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        $headings = array_map(function ($col) {
            return ucwords(str_replace('_', ' ', $col));
        }, $this->columns);

        return array_merge(['No'], $headings);
    }

    public function map($row): array
    {
        $this->rowIndex++;

        $mapped = [$this->rowIndex]; // Nomor urut

        foreach ($this->columns as $col) {
            $mapped[] = $row->$col ?? '';
        }

        return $mapped;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [ // Baris header
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '000000']],
            ],
        ];
    }
}
