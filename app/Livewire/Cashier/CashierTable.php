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
    public $amount_paid;
    public $total_item = 0;
    public $date;
    public $status = 'pending';
    public $change = 0;
    public $discount ;

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
        if (empty($this->items)) {
            toastr()->error('Keranjang tidak boleh kosong!');
            return;
        }

        $discountAmount = ($this->subtotal * $this->discount) / 100;
        $totalAfterDiscount = $this->subtotal - $discountAmount;

        if ($this->amount_paid < $totalAfterDiscount) {
            toastr()->error('Masukkan nominal pembayaran yang cukup!');
            return;
        }

        foreach ($this->items as $item) {
            $product = Product::find($item['id_product']);

            if ($product->stock < $item['stock']) {
                toastr()->error("Stok produk '{$product->name}' tidak mencukupi! Tersedia: {$product->stock}, diminta: {$item['stock']}.");
                return;
            }
        }

        foreach ($this->items as $item) {
            Transaction::create([
                'code' => 'TRX-' . now()->timestamp,
                'id_user' => Auth::id(),
                'id_product' => $item['id_product'],
                'date' => now()->toDateTimeString(),
                'total_item' => $item['stock'],
                'subtotal' => $item['price_sell'] * $item['stock'],
                'amount_paid' => $this->amount_paid,
                'discount' => $this->discount ?? 0,
                'status' => 'completed',
            ]);

            $product->stock -= $item['stock'];
            $product->save();
        }

        session(['transaction' => [
            'items' => $this->items,
            'subtotal' => $this->subtotal,
            'amount_paid' => $this->amount_paid,
            'discount' => $this->discount ?? 0,
            'change' => $this->change,
        ]]);

        toastr()->success('Transaksi berhasil!');
        $this->reset(['items', 'subtotal', 'amount_paid', 'discount']);
        return redirect()->route('cashier.print');
    }




    public function clear()
    {
        $this->reset(['items', 'subtotal', 'amount_paid', 'total_item']);
    }


    public function calculateChange()
    {
        $discountAmount = ($this->subtotal * $this->discount) / 100;
        $totalAfterDiscount = $this->subtotal - $discountAmount;
        $this->change = (float) $this->amount_paid - (float) $totalAfterDiscount;
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
