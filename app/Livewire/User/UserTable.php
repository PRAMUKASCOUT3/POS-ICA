<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;

class UserTable extends Component
{
    public $user;

    protected $listeners = ['delete' => 'render']; 

    public function mount()
    {
        $this->user = User::where('isAdmin', 0 )->orderBy('created_at','desc')->get();
    }
    public function render()
    {
        return view('livewire.user.user-table',[
            'users' => $this->user,
        ]);
    }

    public function delete($id)
    {
        User::find($id)->delete();
        $this->user = User::where('isAdmin', 0)->get();
        toastr()->success('Data Berhasil Dihapus');
        $this->dispatch('delete');
    }
}
