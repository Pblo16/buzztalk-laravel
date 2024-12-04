<?php

namespace App\Livewire\Profile;

use Livewire\Component;

class PostModal extends Component
{
    public $postData = null;
    public $show = false;

    protected $listeners = [
        'show-post' => 'showPost',
        'escapePressed' => 'close'
    ];

    public function showPost($postData)
    {
        $this->postData = $postData;
        $this->show = true;
    }

    public function close()
    {
        $this->show = false;
    }

    public function render()
    {
        return view('livewire.profile.post-modal');
    }
}
