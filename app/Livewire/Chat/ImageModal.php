<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use Livewire\Attributes\On;

class ImageModal extends Component
{
    public $show = false;
    public $currentImage = '';
    public $images = [];
    public $currentIndex = 0;

    protected $listeners = [
        'escapePressed' => 'closeModal'
    ];

    public function mount()
    {
        $this->show = false;
    }

    #[On('show-image-modal')] 
    public function openModal($data)
    {
        $this->show = true;
        $this->currentImage = $data['image'];
        $this->images = $data['images'];
        $this->currentIndex = (int) $data['index'];
    }

    public function closeModal()
    {
        $this->show = false;
        $this->currentImage = '';
        $this->images = [];
        $this->currentIndex = 0;
        $this->dispatch('modal-closed');
    }

    public function previousImage()
    {
        if (empty($this->images)) return;
        $this->currentIndex = ($this->currentIndex - 1 + count($this->images)) % count($this->images);
        $this->currentImage = $this->images[$this->currentIndex];
    }

    public function nextImage()
    {
        if (empty($this->images)) return;
        $this->currentIndex = ($this->currentIndex + 1) % count($this->images);
        $this->currentImage = $this->images[$this->currentIndex];
    }

    public function render()
    {
        return view('livewire.chat.image-modal')->extends('layouts.app');
    }
}