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

    if (!auth()->attempt(
        ['email' => $this->email, 'password' => $this->password],
        $this->remember
    )) {
        session()->flash('error', 'Invalid credentials');
        return;
    }

    session()->regenerate();

    return redirect()->intended(route('dashboard'));
}



    public function render()
    {
        return view('livewire.auth.login');
    }
}
