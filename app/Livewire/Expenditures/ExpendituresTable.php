<?php

namespace App\Livewire\Expenditures;

use App\Models\Expenditure;
use Livewire\Component;

class ExpendituresTable extends Component
{
    public $expenditures;
    protected $listeners = ['Delete' => 'render'];
    public function mount()
    {
        $this->expenditures = Expenditure::all();
    }
    public function render()
    {
        return view('livewire.expenditures.expenditures-table',[
            'expenditures' => $this->expenditures,
        ]);
    }

    public function delete($id)
    {
        $expenditure  = Expenditure::findorFail($id);
        $expenditure->delete();
        toastr()->success('Data Berhasil Dihapus!');
        $this->dispatch('Delete');
    }
}
