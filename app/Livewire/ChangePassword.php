<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ChangePassword extends Component
{
    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    public function changePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Check if current password matches
        if (!Hash::check($this->current_password, $user->password)) {
            $this->addError('current_password', 'The current password is incorrect.');
            return;
        }

        // Update password
        $user->password = Hash::make($this->new_password);
        $user->save();

        // Reset form
        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);

        session()->flash('message', 'Password changed successfully.');
    }

    public function render()
    {
        return view('livewire.change-password');
    }
}
