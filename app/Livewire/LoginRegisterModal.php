<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginRegisterModal extends Component
{
    public $showModal = false;
    public $form = 'login';
    public $first_name = '';
    public $last_name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';

    public $remember = false;

    protected $listeners = ['show-modal' => 'showModal'];

    public function showModal()
    {
        $this->showModal = true;
    }
    public function register()
    {
        Log::info('register');
        try {
            $this->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6|confirmed',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error: ' . $e->getMessage());
            return;
        }

        Log::info('register3');

        $user = \App\Models\User::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => \Hash::make($this->password),
        ]);
        Log::info('register2');


        Auth::login($user);

        $this->showModal = false;
        return redirect()->intended('/');
    }

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            $this->addError('password', 'Email or password do not match our records.');
            return;
        }

        // Authentication passed...
        $this->showModal = false;
        return redirect()->intended('/');
    }

    public function render()
    {
        return view('livewire.login-register-modal');
    }
}
