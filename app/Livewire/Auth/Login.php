<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email;
    public $password;
    public $remember = false; // For "remember me"

    public function userLogin()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Use Fortify-compatible Auth::attempt()
        if (Auth::attempt([
            'email' => $this->email,
            'password' => $this->password,
        ], $this->remember)) {

            session()->regenerate(); // Fortify does this internally
            return redirect()->intended(route('dashboard')); // or wherever
        }

        // Show login failure message
        $this->addError('email', 'These credentials do not match our records.');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
