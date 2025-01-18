<?php

namespace App\Livewire\Supplier;

use App\Models\Supplier;
use Livewire\Component;

class SupplierTabel extends Component
{
    
    public $suppliers;

    protected $listeners = ['DeleteUser' => 'render'];
    public function mount()
    {
        $this->suppliers = Supplier::orderBy('created_at', 'desc')->get();
    }
    public function render()
    {
        return view('livewire.supplier.supplier-tabel',[
            'suppliers' => $this->suppliers
        ]);
    }

    public function delete($id)
    {
        $suppliers = Supplier::find($id);
        $suppliers->delete();
         toastr()->success('Data Berhasil Dihapus!');

         $this->dispatch('DeleteUser');
    }
}
