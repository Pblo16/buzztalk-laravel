<?php

namespace App\Livewire\Post;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UploadPost extends Component
{
    use WithFileUploads;

    public $media;
    public $caption;

    protected $rules = [
        'caption' => 'nullable|string|max:255',
        'media' => 'required|file|max:102400|mimetypes:video/mp4,video/quicktime,image/jpeg,image/png,image/gif',
    ];

    public function updatedMedia()
    {
        $this->validateOnly('media');
        
        // Ensure temporary URL is generated
        if ($this->media) {
            try {
                $this->media->temporaryUrl();
            } catch (\Exception $e) {
                Log::error('Error generating temporary URL:', ['error' => $e->getMessage()]);
                $this->addError('media', 'Error processing media file');
            }
        }
    }

    public function save()
    {
        $this->validate();

        try {
            Log::info('Processing file:', ['mime' => $this->media->getMimeType(), 'size' => $this->media->getSize()]);

            $mediaType = str_starts_with($this->media->getMimeType(), 'video/') ? 'video' : 'image';
            $folder = $mediaType === 'video' ? 'videos' : 'images';

            $path = $this->media->store("posts/{$folder}", 'public');
            Log::info('File stored at:', ['path' => $path]);

            $post = Post::create([
                'user_id' => Auth::id(),
                'media_path' => $path,
                'media_type' => $mediaType,
                'caption' => $this->caption,
            ]);

            Log::info('Post created:', ['post_id' => $post->id]);
        } catch (\Exception $e) {
            Log::error('Error saving post:', ['error' => $e->getMessage()]);
            session()->flash('error', 'Error saving post: ' . $e->getMessage());
            return;
        }

        redirect()->route('profile.index');
    }

    public function render()
    {
        return view('livewire.post.upload-post');
    }
}
