<?php

namespace App\Livewire\Supplier;

use App\Models\Supplier;
use Livewire\Component;

class SupplierEdit extends Component
{
    public $suppliers_id;
    public $name;
    public $contact_person;
    public $address;

    public function mount(Supplier $suppliers)
    {
        $this->suppliers_id = $suppliers->id_supplier;
        $this->name = $suppliers->name;
        $this->contact_person = $suppliers->contact_person;
        $this->address = $suppliers->address;
    }

    public function render()
    {
        return view('livewire.supplier.supplier-edit', [
            'suppliers' => Supplier::find($this->suppliers_id),
        ]);
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:30',
            'contact_person' => 'required|string|max:15',
            'address' => 'required|string|max:150',
        ]);

        Supplier::find($this->suppliers_id)->update([
            'name' => $this->name,
            'contact_person' => $this->contact_person,
            'address' => $this->address,
        ]);

        toastr()->success('Data Berhasil Diubah!');
        return redirect()->route('supplier.index');
    }
}
