<?php

namespace App\Livewire\Profile;

use App\Models\Post;
use Livewire\Component;

class PostModal extends Component
{
    public $show = false;
    public $post = null;

    protected $listeners = ['showPost'];

    public function showPost($postId)
    {
        $this->post = Post::with('user')->find($postId);
        $this->show = true;
    }

    public function render()
    {
        return view('livewire.profile.post-modal');
    }
}
