<?php

namespace App\Livewire;

use Livewire\Component;

class UserDetailsModal extends Component
{

    public $open = false;
    public function save()
    {
        // Qui inserire la logica per salvare i dettagli dell'utente

        $this->open = false;
    }
    public function mount()
    {
        $this->open = true;
    }

    public function render()
    {
        return view('livewire.user-details-modal');
    }
}
