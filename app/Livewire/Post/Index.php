<?php

namespace App\Livewire\Post;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    
    public $hasMorePages = true;
    public $videos = [];

    public function mount()
    {
        $this->loadInitialVideos();
    }

    public function incrementViews($postId)
    {
        Post::where('id', $postId)->increment('views');
    }

    public function loadInitialVideos()
    {
        $videos = Post::where('media_type', 'video')
            ->with('user')
            ->latest()
            ->paginate(10);
            
        $this->videos = $videos->items();
        $this->hasMorePages = $videos->hasMorePages();
    }

    public function loadMore()
    {
        $page = (count($this->videos) / 10) + 1;

        $newVideos = Post::where('media_type', 'video')
            ->with('user')
            ->latest()
            ->paginate(10, ['*'], 'page', $page);
            
        $this->videos = array_merge($this->videos, $newVideos->items());
        $this->hasMorePages = $newVideos->hasMorePages();
    }

    public function render()
    {
        return view('livewire.post.index', [
            'videos' => $this->videos,
        ]);
    }
}
