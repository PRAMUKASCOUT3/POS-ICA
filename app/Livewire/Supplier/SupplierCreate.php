<?php

namespace App\Livewire\Supplier;

use App\Models\Supplier;
use Livewire\Component;

class SupplierCreate extends Component
{

    public $name, $contact_person, $address;

    protected $rules = [
        'name' => 'required|string',
        'contact_person' => 'required|string',
        'address' => 'required|string',
    ];

    public function save()
    {
        // Validate input
        $this->validate();

        // Save supplier data
        Supplier::create([
            'name' => $this->name,
            'contact_person' => $this->contact_person,
            'address' => $this->address,
        ]);

        // Success notification
        toastr()->success('Data Berhasil Ditambahkan!');

        // Reset form fields
        $this->reset(['name', 'contact_person', 'address']);

        // Redirect to the index route
        return redirect()->route('supplier.index');
    }


    public function render()
    {
        return view('livewire.supplier.supplier-create');
    }
}
