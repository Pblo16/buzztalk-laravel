<?php

namespace App\Livewire\Post;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Feed extends Component
{
    public function showPostModal($postId)
    {
        $this->dispatch('showPost', postId: $postId);
    }

    public function render()
    {
        return view('livewire.post.feed', [
            'posts' => Post::with('user')
                ->latest()
                ->get()
        ]);
    }
}