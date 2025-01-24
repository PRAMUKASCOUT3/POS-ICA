<?php

namespace App\Livewire\Cashier;

use App\Models\Cashier;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class CashierTable extends Component
{
    public $items = [];
    public $subtotal = 0;
    public $amount_paid ;
    public $total_item = 0;
    public $date;
    public $status = 'pending';
    public $change = 0;

    public $products;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public function mount()
    {
        $this->date = now()->toDateTimeString(); // Set tanggal transaksi
    }

    public function calculateSubtotal()
    {
        $this->subtotal = array_reduce($this->items, function ($carry, $item) {
            return $carry + ($item['price_sell'] * $item['stock']);
        }, 0);

        $this->total_item = count($this->items);
    }
    public function addItem($productId)
    {
        $product = Product::find($productId);
        $this->items[] = [
            'id_product' => $product->id_product,
            'name' => $product->name,
            'price_sell' => $product->price_sell,
            'stock' => 1,
        ];

        $this->calculateSubtotal();
    }
    public function updateQuantity($index, $stock)
    {
        $this->items[$index]['stock'] = $stock;
        $this->total_item = collect($this->items)->sum('stock');
        $this->calculateSubtotal();
    }

    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items); // Reindex array
        $this->calculateSubtotal();
    }

    public function saveTransaction()
    {
        // Validasi jika keranjang kosong
        if (empty($this->items)) {
            toastr()->error('Keranjang tidak boleh kosong!');
            return;
        }
    
        // Validasi pembayaran
        if ($this->amount_paid < $this->subtotal) {
            toastr()->error('Masukkan nominal pembayaran yang cukup!');
            return;
        }
    
        // Validasi stok untuk semua produk di keranjang
        foreach ($this->items as $item) {
            $product = Product::find($item['id_product']);
    
            if ($product->stock < $item['stock']) {
                toastr()->error("Stok produk '{$product->name}' tidak mencukupi! Tersedia: {$product->stock}, diminta: {$item['stock']}.");
                return;
            }
        }
    
        // Jika semua stok mencukupi, lanjutkan menyimpan transaksi
        foreach ($this->items as $item) {
            $transaction = Transaction::create([
                'code' => 'TRX-' . now()->timestamp, // Kode transaksi unik
                'id_user' => Auth::id(), // ID pengguna yang melakukan transaksi
                'id_product' => $item['id_product'], // ID produk
                'date' => now()->toDateTimeString(), // Tanggal dan waktu transaksi
                'total_item' => $item['stock'], // Jumlah produk
                'subtotal' => $item['price_sell'] * $item['stock'], // Subtotal untuk produk ini
                'amount_paid' => $this->amount_paid, // Total pembayaran
                'status' => 'completed', // Status transaksi
            ]);
    
            // Kurangi stok produk
            $product = Product::find($item['id_product']);
            $product->stock -= $item['stock'];
            $product->save();
        }
    
        // Simpan detail transaksi untuk cetak
        session(['transaction' => [
            'items' => $this->items,
            'subtotal' => $this->subtotal,
            'amount_paid' => $this->amount_paid,
            'change' => $this->amount_paid - $this->subtotal,
        ]]);
    
        toastr()->success('Transaksi berhasil!');
    
        // Reset keranjang dan form pembayaran
        $this->reset(['items', 'subtotal', 'amount_paid']);
    
        // Redirect ke halaman cetak
        return redirect()->route('cashier.print');
    }
    



    public function clear()
    {
        $this->reset(['items', 'subtotal', 'amount_paid', 'total_item']);
    }


    public function calculateChange()
    {
        $this->change = (float) $this->amount_paid - (float) $this->subtotal;
    }

    // Fungsi yang otomatis dipanggil ketika amount_paid diperbarui
    public function updatedAmountPaid()
    {
        $this->calculateChange();
    }

    public function updatingSearch()
    {
        // Reset pagination when search input is updated
        $this->resetPage();
    }
    public function render()
    {
        return view('livewire.cashier.cashier-table', [
            'product' => Product::where('name', 'like', '%' . $this->search . '%')
                ->paginate(5)
        ]);
    }
}
