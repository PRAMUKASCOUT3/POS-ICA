<?php

namespace App\Exports;

use App\Models\Cashier;
use App\Models\Expenditure;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CashiersExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithEvents
{
    protected $start_date;
    protected $end_date;

    public function __construct($start_date = null, $end_date = null)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function collection()
    {
        // Ambil transaksi berdasarkan filter tanggal
        $cashiers = Cashier::with('user', 'product')
            ->when($this->start_date && $this->end_date, function ($query) {
                $query->whereBetween('date', [$this->start_date, $this->end_date]);
            })
            ->get();

        // Ambil pengeluaran berdasarkan filter tanggal
        $expenditures = Expenditure::when($this->start_date && $this->end_date, function ($query) {
            $query->whereBetween('date', [$this->start_date, $this->end_date]);
        })->get();

        // Hitung total pendapatan dan pengeluaran
        $this->total_pendapatan = $cashiers->sum('subtotal');
        $this->total_pengeluaran = $expenditures->sum('nominal');
        $this->total_keseluruhan = $this->total_pendapatan - $this->total_pengeluaran;

        return $cashiers;
    }

    public function headings(): array
    {
        return [
            '#',
            'NAMA KASIR',
            'KODE TRANSAKSI',
            'TANGGAL',
            'NAMA PRODUK',
            'JUMLAH PRODUK',
            'SUBTOTAL',
            'BAYAR',
        ];
    }

    public function map($cashier): array
    {
        static $nomor = 0;

        return [
            ++$nomor,
            $cashier->user->name,
            $cashier->code,
            $cashier->date,
            $cashier->product->name,
            $cashier->total_item,
            'Rp ' . number_format($cashier->subtotal, 0, ',', '.'),
            'Rp ' . number_format($cashier->amount_paid, 0, ',', '.'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Gaya header
            2 => ['font' => ['bold' => true]],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $tahun = Carbon::now()->year;
                $bulan = Carbon::now()->format('F');

                // Merge header title
                $sheet->mergeCells('A1:H1');
                $sheet->setCellValue('A1', 'LAPORAN TRANSAKSI ' . strtoupper($bulan) . ' ' . $tahun);
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 14],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                // Pindahkan headings ke baris kedua
                $headings = $this->headings();
                $sheet->fromArray($headings, null, 'A2', true);

                // Tambahkan data transaksi ke bawah header
                $data = $this->collection()->map(function ($cashier, $index) {
                    return [
                        $index + 1,
                        $cashier->user->name,
                        $cashier->code,
                        $cashier->date,
                        $cashier->product->name,
                        $cashier->total_item,
                        'Rp ' . number_format($cashier->subtotal, 0, ',', '.'),
                        'Rp ' . number_format($cashier->amount_paid, 0, ',', '.'),
                    ];
                })->toArray();

                $sheet->fromArray($data, null, 'A3', true);

                // Tambahkan ringkasan di bawah data transaksi
                $last_row = $sheet->getHighestRow() + 1;
                $sheet->setCellValue("A{$last_row}", 'Total Pendapatan');
                $sheet->setCellValue("G{$last_row}", 'Rp ' . number_format($this->total_pendapatan, 0, ',', '.'));

                $last_row++;
                $sheet->setCellValue("A{$last_row}", 'Pengeluaran');
                $sheet->setCellValue("G{$last_row}", 'Rp ' . number_format($this->total_pengeluaran, 0, ',', '.'));

                $last_row++;
                $sheet->setCellValue("A{$last_row}", 'Total Keseluruhan');
                $sheet->setCellValue("G{$last_row}", 'Rp ' . number_format($this->total_keseluruhan, 0, ',', '.'));

                // Tambahkan gaya untuk ringkasan
                $sheet->getStyle("A{$last_row}:G{$last_row}")->applyFromArray([
                    'font' => ['bold' => true],
                ]);
            },
        ];
    }
}
