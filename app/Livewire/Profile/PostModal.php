<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostModal extends Component
{
    public $show = false;
    public $post;
    public $isEditing = false;
    public $editableCaption;

    protected $listeners = ['showPost'];

    public function showPost($postId)
    {
        $this->post = Post::with('user')->find($postId);
        $this->editableCaption = $this->post->caption;
        $this->show = true;
        $this->isEditing = false;
    }

    public function deletePost($postId)
    {
        $post = Post::find($postId);

        if ($post && $post->user_id === auth()->id()) {
            // Delete file from storage
            if ($post->media_path) {
                Storage::disk('public')->delete($post->media_path);
            }

            $post->delete();
            $this->show = false;
            $this->dispatch('post-deleted');
        }

        return redirect()->route('profile.index');
    }

    public function editPost($postId)
    {
        $post = Post::find($postId);
        if ($post && $post->user_id === auth()->id()) {
            $this->isEditing = true;
            $this->editableCaption = $post->caption;
        }
    }

    public function saveEdit()
    {
        if ($this->post && $this->post->user_id === auth()->id()) {
            $this->post->update([
                'caption' => $this->editableCaption
            ]);
            $this->isEditing = false;
            $this->dispatch('post-updated');
        }
    }

    public function cancelEdit()
    {
        $this->isEditing = false;
        $this->editableCaption = $this->post->caption;
    }

    public function render()
    {
        return view('livewire.profile.post-modal');
    }
}
