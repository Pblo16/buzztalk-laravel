<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use App\Models\Post;
use App\Models\User;

class Gallery extends Component
{
    public $posts;
    public User $user;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->loadPosts();
    }

    public function loadPosts()
    {
        $this->posts = $this->user->posts()->latest()->get();
    }

    public function showPostModal($postId)
    {
        $this->dispatch('showPost', postId: $postId);
    }

    public function render()
    {
        return view('livewire.profile.gallery');
    }
}
