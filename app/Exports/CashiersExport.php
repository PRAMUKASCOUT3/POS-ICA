<?php

namespace App\Exports;

use App\Models\Transaction;
use App\Models\Expenditure;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Events\AfterSheet;

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
        $cashiers = Transaction::with('user', 'product')
            ->when($this->start_date && $this->end_date, function ($query) {
                $query->whereBetween('date', [$this->start_date, $this->end_date]);
            })
            ->get();

        $expenditures = Expenditure::when($this->start_date && $this->end_date, function ($query) {
            $query->whereBetween('date', [$this->start_date, $this->end_date]);
        })->get();

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
            'DESKRIPSI PENGELUARAN',
        ];
    }

    public function map($cashier): array
    {
        static $nomor = 0;

        $expenditures = Expenditure::when($this->start_date && $this->end_date, function ($query) {
            $query->whereBetween('date', [$this->start_date, $this->end_date]);
        })->get();

        $expenditure_description = $expenditures->pluck('description')->implode(', ') ?: '-';

        return [
            ++$nomor,
            $cashier->user->name,
            $cashier->code,
            $cashier->date,
            $cashier->product->name,
            $cashier->total_item,
            'Rp ' . number_format($cashier->subtotal, 0, ',', '.'),
            'Rp ' . number_format($cashier->amount_paid, 0, ',', '.'),
            $expenditure_description,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
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
                $sheet->mergeCells('A1:I1');
                $sheet->setCellValue('A1', 'LAPORAN TRANSAKSI ' . strtoupper($bulan) . ' ' . $tahun);
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 14],
                    'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
                ]);

                // Tambahkan data ke Excel
                $data = $this->collection()->map(function ($cashier, $index) {
                    $expenditures = Expenditure::when($this->start_date && $this->end_date, function ($query) {
                        $query->whereBetween('date', [$this->start_date, $this->end_date]);
                    })->get();

                    $expenditure_description = $expenditures->pluck('description')->implode(', ') ?: '-';

                    return [
                        $index + 1,
                        $cashier->user->name,
                        $cashier->code,
                        $cashier->date,
                        $cashier->product->name,
                        $cashier->total_item,
                        'Rp ' . number_format($cashier->subtotal, 0, ',', '.'),
                        'Rp ' . number_format($cashier->amount_paid, 0, ',', '.'),
                        $expenditure_description,
                    ];
                })->toArray();

                $sheet->fromArray($this->headings(), null, 'A2', true);
                $sheet->fromArray($data, null, 'A3', true);

                // Tambahkan ringkasan
                $last_row = $sheet->getHighestRow() + 1;
                $sheet->setCellValue("A{$last_row}", 'Total Pendapatan');
                $sheet->setCellValue("H{$last_row}", 'Rp ' . number_format($this->total_pendapatan, 0, ',', '.'));

                $last_row++;
                $sheet->setCellValue("A{$last_row}", 'Pengeluaran');
                $sheet->setCellValue("H{$last_row}", 'Rp ' . number_format($this->total_pengeluaran, 0, ',', '.'));

                $last_row++;
                $sheet->setCellValue("A{$last_row}", 'Total Penjualan Bersih');
                $sheet->setCellValue("H{$last_row}", 'Rp ' . number_format($this->total_keseluruhan, 0, ',', '.'));

                $sheet->getStyle("A{$last_row}:H{$last_row}")->applyFromArray([
                    'font' => ['bold' => true],
                ]);
            },
        ];
    }
}
