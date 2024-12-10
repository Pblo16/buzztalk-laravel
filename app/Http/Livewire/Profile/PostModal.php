<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use App\Models\Post;

class PostModal extends Component
{
    public $show = false;
    public $post;

    public function mount()
    {
        $this->listeners = [
            'showPost' => 'showPostModal'
        ];
    }

    public function showPostModal($postId)
    {
        $this->post = Post::with('user')->find($postId);
        $this->show = true;
    }

    public function render()
    {
        return view('livewire.profile.post-modal');
    }
}