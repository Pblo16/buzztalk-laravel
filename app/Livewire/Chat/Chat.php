<?php

namespace App\Livewire\Chat;

use App\Models\Conversation;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class Chat extends Component
{
    public ?Conversation $currentConversation = null;
    public $isMobile = false;

    protected $listeners = [
        'conversation-selected' => 'setActiveConversation'
    ];
    public $showMobileChat = false;

    public function toggleMobileChat()
    {
        $this->showMobileChat = !$this->showMobileChat;
    }

    public function hideMobileChat()
    {
        $this->showMobileChat = false;
    }

    #[On('show-mobile-chat')]
    public function showMobileChat()
    {
        if ($this->isMobile) {
            $this->showMobileChat = true;
        }
    }

    public function getListeners()
    {
        return [
            "echo-private:conversation.{$this->currentConversation?->id},MessageSent" => 'refreshMessages',
            'conversation-selected' => 'setActiveConversation',
        ];
    }

    public function mount()
    {
        $this->isMobile = request()->header('Sec-Ch-Ua-Mobile') === '?1' 
            || request()->header('User-Agent') && strpos(request()->header('User-Agent'), 'Mobile') !== false;

        $firstConversation = Auth::user()
            ->conversations()
            ->latest()
            ->first();

        if ($firstConversation) {
            $this->setActiveConversation($firstConversation->id);
        }
    }

    #[On('conversation-selected')]
    public function setActiveConversation($conversationId)
    {
        if ($this->currentConversation && $this->currentConversation->id == $conversationId) {
            return;
        }

        try {
            $this->currentConversation = auth()->user()
                ->conversations()
                ->where('conversations.id', $conversationId)
                ->with(['users'])
                ->firstOrFail();
        } catch (\Exception $e) {
            $this->currentConversation = null;
        }
    }

    public function boot()
    {
        $this->dispatch('initializeResizeListener');
    }

    #[On('screen-resized')]
    public function handleScreenResize($width)
    {
        $this->isMobile = $width < 768;
        if (!$this->isMobile) {
            $this->showMobileChat = false;
        }
    }

    public function render()
    {
        return view('livewire.chat.chat', [
            'conversations' => $this->conversations ?? []
        ]);
    }
}
