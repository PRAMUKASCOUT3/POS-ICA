<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Events\AfterSheet;
use Carbon\Carbon;

class ProductsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Product::select('id', 'category_id', 'code', 'name', 'brand', 'stock', 'price_buy', 'price_sell', 'unit')->get();
    }

    public function headings(): array
    {
        return [
            '#',
            'KODE PRODUK',
            'KATEGORI',
            'NAMA PRODUK',
            'MERK PRODUK',
            'STOK',
            'HARGA BELI',
            'HARGA JUAL',
            'SATUAN',
        ];
    }

    public function map($products): array
    {
        static $nomor = 0; // Static variable to reset numbering per export

        return [
            ++$nomor,
            $products->code,
            $products->category->name,
            $products->name,
            $products->brand,
            $products->stock,
            $products->price_buy,
            $products->price_sell,
            $products->unit,
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
                $sheet->mergeCells('A1:I1');

                // Set the value and style for the header
                $sheet->setCellValue('A1', 'LAPORAN PRODUK TAHUN ' . $tahun);
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
                $data = $this->collection()->map(function ($products) use (&$nomor) {
                    return [
                        ++$nomor,
                        $products->code,
                        $products->category->name ?? 'N/A', // Mengambil nama kategori atau 'N/A' jika null
                        $products->name,
                        $products->brand,
                        $products->stock,
                        'Rp' . number_format($products->price_buy, 0, ',', '.'), // Format harga beli
                        'Rp' . number_format($products->price_sell, 0, ',', '.'), // Format harga jual
                        $products->unit,
                    ];
                })->toArray();

                $sheet->fromArray($data, null, 'A3', true);
            },
        ];
    }
}
