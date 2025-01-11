<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;

class UserCreate extends Component
{
    public $name,$email,$password,$isAdmin;
    public $code;

    protected $rules = [
        'id_user',
        'name' =>'required|min:3',
        'email' =>'required|email|unique:users',
        'password' => 'required|min:8|',
    ];

    public function mount()
    {
        $this->code = 'US' . str_pad(User::max('id_user') + 1, 4, '0', STR_PAD_LEFT);
    }

    public function save()
    {
        // Validate input
        $this->validate([
            'name' =>'required|min:3',
            'email' =>'required|email|unique:users',
            'password' => 'required|min:8|',
        ]);
    
        // Save user to the database
        User::create([
            'id_user' => User::max('id_user') + 1, // Auto-increment id_user
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'code' => $this->code,
            'isAdmin' => 0, // Default value for isAdmin
        ]);
    
        // Reset the form inputs
        $this->reset(['name', 'email', 'password']);
        $this->code = 'US' . str_pad(User::max('id_user') + 1, 4, '0', STR_PAD_LEFT);
    
        // Display success message
        toastr()->success('Data Berhasil Ditambah!');
        return redirect()->route('pengguna.index');
    }
    
    public function render()
    {
        return view('livewire.user.user-create');
    }
}
