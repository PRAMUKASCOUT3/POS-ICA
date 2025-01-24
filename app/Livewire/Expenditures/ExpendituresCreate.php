<?php

namespace App\Livewire\Expenditures;

use App\Models\Expenditure;
use Livewire\Component;

class ExpendituresCreate extends Component
{
    public $date,$description,$nominal;
    protected $rules = [
        'date' => 'required|date',
        'description' =>'required|string',
        'nominal' =>'required|numeric'
    ];

    public function save()
    {
        $this->validate([
            'date' => 'required|date',
        'description' =>'required|min:5',
        'nominal' =>'required|numeric'
        ]);

        Expenditure::create([
            'date' => $this->date,
            'description' => $this->description,
            'nominal' => $this->nominal,
        ]);

        toastr()->success('Data Berhasil Ditambahkan');

        $this->reset(['date', 'description', 'nominal']);

        redirect()->route('expenditures.index');
    }
    public function render()
    {
        return view('livewire.expenditures.expenditures-create');
    }
}
