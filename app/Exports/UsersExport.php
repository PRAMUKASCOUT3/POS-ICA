<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Events\AfterSheet;
use Carbon\Carbon;

class UsersExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::select('id', 'code', 'name', 'email')->where('isAdmin', 0)->get();
    }

    public function headings(): array
    {
        return [
            '#',
            'KODE KASIR',
            'NAMA PENGGUNA/KASIR',
            'EMAIL'
        ];
    }

    public function map($users): array
    {
        static $nomor = 0; // Static variable to reset numbering per export

        return [
            ++$nomor,
            $users->code,
            $users->name,
            $users->email,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the second row (headings) as bold text.
            2 => ['font' => ['bold' => true]],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $tahun = Carbon::now()->year;

                // Merge cells for the header
                $sheet->mergeCells('A1:D1');

                // Set the value and style for the header
                $sheet->setCellValue('A1', 'LAPORAN PENGGUNA TAHUN ' . $tahun);
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ]);

                // Adjust the row height for the header
                $sheet->getRowDimension(1)->setRowHeight(20);

                // Shift headings to row 2
                $sheet->fromArray($this->headings(), null, 'A2', true);

                // Shift data to start from row 3
                $nomor = 0; // Initialize numbering outside of the map function
                $data = $this->collection()->map(function ($user) use (&$nomor) {
                    return [
                        ++$nomor,
                        $user->code,
                        $user->name,
                        $user->email
                    ];
                })->toArray();

                $sheet->fromArray($data, null, 'A3', true);
            },
        ];
    }
}
