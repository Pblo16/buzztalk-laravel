<?php

namespace App\Livewire\Ui;

use Livewire\Component;

class Navigation extends Component
{
    public $isOpen = false;

    public function toggleMenu()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function mount()
    {
        $this->isOpen = false;
    }

    public function render()
    {
        return view('livewire.ui.navigation');
    }
}
