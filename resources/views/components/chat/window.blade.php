@props(['conversation'])

<div class="flex flex-col  h-full max-h-[calc(100vh-72px)]">
    <div class="p-4 border-b dark:border-gray-800">
        <h2 class="font-semibold text-lg">{{ $conversation->name }}</h2>
    </div>

    <livewire:chat.message-list :conversation="$conversation" :key="'chat-'.$conversation->id" />

    <livewire:chat.message-input :conversation="$conversation" :key="'input-'.$conversation->id" />
</div>