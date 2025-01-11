<?php

namespace App\Livewire\Expenditures;

use App\Models\Expenditure;
use Livewire\Component;

class ExpendituresEdit extends Component
{
    public $expenditure_id;
    public $date,$description,$nominal;

    public function mount($expenditure)
    {
        $this->expenditure_id = $expenditure->id_expenditure;
        $this->date = $expenditure->date;
        $this->description = $expenditure->description;
        $this->nominal = $expenditure->nominal;
    }
    
    public function update()
    {
        $validatedData = $this->validate([
            'date' => ['required', 'date'],
            'description' => ['required','string','max:255'],
            'nominal' => ['required', 'numeric','min:0'],
        ]);

        $expenditure = Expenditure::find($this->expenditure_id);
        $expenditure->update($validatedData);

        return redirect()->route('expenditures.index')->with('success','Data Berhasil Diubah');
    }

    public function render()
    {
        return view('livewire.expenditures.expenditures-edit',[
            'expenditure' => Expenditure::find($this->expenditure_id)
        ]);
    }
}
