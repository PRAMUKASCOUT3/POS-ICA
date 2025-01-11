<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;

class UserEdit extends Component
{
    public $user_id, $name, $email;
    public function mount($user)
    {
        $this->user_id = $user->id_user;
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function update()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $this->user_id . ',id_user'],
        ]);

        $user = User::find($this->user_id);
        $user->name = $this->name;
        $user->email = $this->email;
        $user->save();

        toastr()->success('Data Berhasil Diubah');
        return redirect()->route('pengguna.index');
    }

    public function render()
    {
        return view('livewire.user.user-edit', [
            'user' => User::find($this->user_id)
        ]);
    }
}
