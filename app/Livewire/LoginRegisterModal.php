<?php

namespace App\Livewire;

use Livewire\Component;

class LoginRegisterModal extends Component
{
    public $showModal = false;
    public $form = 'login';

    protected $listeners = ['show-modal' => 'showModal'];

    public function showModal()
    {
        $this->showModal = true;
    }
    public function showForm($form)
    {
        $this->form = $form;
    }
    public function closeModal()
    {
        $this->showModal = false;
    }
    public function render()
    {
        return view('livewire.login-register-modal');
    }
}
