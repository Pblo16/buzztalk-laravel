<?php

namespace App\Livewire\Chat;

use Livewire\Component;

class ImageModal extends Component
{
    public $show = false;
    public $currentImage = '';
    public $images = [];
    public $currentIndex = 0;

    public function mount()
    {
        $this->show = false;
    }

    public function openModal($image, $allImages, $index)
    {
        $this->currentImage = $image;
        $this->images = $allImages;
        $this->currentIndex = $index;
        $this->show = true;
    }

    public function closeModal()
    {
        $this->show = false;
    }

    public function previousImage()
    {
        $this->currentIndex = ($this->currentIndex - 1 + count($this->images)) % count($this->images);
        $this->currentImage = $this->images[$this->currentIndex];
    }

    public function nextImage()
    {
        $this->currentIndex = ($this->currentIndex + 1) % count($this->images);
        $this->currentImage = $this->images[$this->currentIndex];
    }

    public function render()
    {
        return view('livewire.chat.image-modal');
    }
}