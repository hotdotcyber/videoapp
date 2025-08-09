<?php

namespace App\Livewire\Auth;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class Register extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $channel_name;

    public function register()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'channel_name' => 'required|string|max:100|unique:channels,name',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        // Create channel
        $user->channel()->create([
            'name' => $this->channel_name,
            'slug' => Str::slug($this->channel_name, '-'),
            'uid' => uniqid(true),
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function render()
    {

        
        return view('livewire.auth.register');
    }
}
