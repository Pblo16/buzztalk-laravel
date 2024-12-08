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
        $post = $this->posts->find($postId);
        $postData = [
            'id' => $post->id,
            'media_type' => $post->media_type,
            'media_url' => $post->media_url,
            'user' => [
                'name' => $post->user->name,
                'profile_photo_url' => $post->user->profile_photo_url
            ],
            'caption' => $post->caption,
        ];

        $this->dispatch('show-post', postData: $postData);
    }

    public function render()
    {
        return view('livewire.profile.gallery');
    }
}
