<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Conversation;
use App\Models\FriendRequest;
use Livewire\Component;

class SearchUsers extends Component
{
    public $search = '';
    public $users = [];
    public $showResults = false;

    public function mount()
    {
        $this->users = collect();
    }

    public function updatedSearch()
    {
        if (strlen($this->search) >= 2) {
            $this->users = User::where('name', 'like', '%' . $this->search . '%')
                ->where('id', '!=', auth()->id())
                ->take(5)
                ->get();
            $this->showResults = true;
        } else {
            $this->users = collect();
            $this->showResults = false;
        }
    }

    public function render()
    {
        return view('livewire.search-users');
    }
}
