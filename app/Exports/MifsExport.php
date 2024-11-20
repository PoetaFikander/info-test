<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use App\Models\Reports\Mif;

class MifsExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithColumnFormatting
{

    use Exportable;

    protected Collection $data;
    protected string $reportType;

    public function __construct(Collection $data, string $reportType)
    {
        $this->data = $data;
        $this->reportType = $reportType;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->data;
    }

    public function map($row): array
    {
        if ($this->reportType === 'department') {
            return [
                $row['dep_acronym'],
                $row['agr_count'],
                $row['dev_count'],
                $row['a3_color'],
                $row['a3_mono'],
                $row['a4_color'],
                $row['a4_mono'],
            ];
        } elseif ($this->reportType === 'patron') {
            return [];
        } else {
            return [];
        }

//        return [
//            $row['serviceman_name'],
//            $row['workplace_name'],
//            $row['department_acronym'],
//            $row['year'],
//            $row['month'],
//            $row['salary_gross_basis'],
//            $row['bonus'],
//            // ---- może być też tak $row->{'art_id'},
//        ];
    }

    public function headings(): array
    {
        if ($this->reportType === 'department') {
            return [
                'Oddział', //A
                'Ilość umów', //B
                'Ilość urządzeń', //C
                'A3 kolor', //D
                'A3 mono', //E
                'A4 kolor', //F
                'A4 mono', //G
            ];
        } elseif ($this->reportType === 'patron') {
            return [];
        } else {
            return [];
        }

//        return [
//            'Technik', //A
//            'Stanowisko', //B
//            'Oddział', //C
//            'Rok', //D
//            'Miesiąc', //E
//            'Podstawa', //F
//            'Premia', //G
//        ];
    }

    public function columnFormats(): array
    {
        if ($this->reportType === 'department') {
            return [
                'A' => NumberFormat::FORMAT_TEXT,
                'B' => NumberFormat::FORMAT_NUMBER,
                'C' => NumberFormat::FORMAT_NUMBER,
                'D' => NumberFormat::FORMAT_NUMBER,
                'E' => NumberFormat::FORMAT_NUMBER,
                'F' => NumberFormat::FORMAT_NUMBER,
                'G' => NumberFormat::FORMAT_NUMBER,
            ];
        } elseif ($this->reportType === 'patron') {
            return [];
        } else {
            return [];
        }

//        return [
//            'A' => NumberFormat::FORMAT_TEXT,
//            'B' => NumberFormat::FORMAT_TEXT,
//            'C' => NumberFormat::FORMAT_TEXT,
//            'D' => NumberFormat::FORMAT_NUMBER,
//            'E' => NumberFormat::FORMAT_NUMBER,
//            'F' => NumberFormat::FORMAT_NUMBER_00,
//            'G' => NumberFormat::FORMAT_NUMBER_00,
//        ];
    }

}

