<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UserDetailsModal extends Component
{
    public $isOpen = false;
    public $user;

    protected $listeners = ['openUserModal' => 'openModal'];

    public function openModal()
    {
        $this->isOpen = true;
        $this->user = Auth::user();
    }

    public function logout()
    {
        auth()->logout();
    return redirect('/');
    }

    public function render()
    {
        return view('livewire.user-details-modal');
    }
}
