<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class LoginRegisterModal extends Component
{
    public $showModal = false;
    public $form = 'login';
    public $email = '';
    public $password = '';
    public $remember = false;

    protected $listeners = ['show-modal' => 'showModal'];

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function showModal()
    {
        $this->showModal = true;
    }
    public function register()
    {
        $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = \App\Models\User::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => \Hash::make($this->password),
        ]);

        Auth::login($user);

        $this->showModal = false;
        return redirect()->intended('/');
    }

    public function login()
    {
        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            $this->addError('password', 'Email or password do not match our records.');
            return;
        }

        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Authentication passed...
        $this->showModal = false;
        return redirect()->intended('/');
    }

    public function render()
    {
        return view('livewire.login-register-modal');
    }
}
