@props(['type', 'message'])

<div class="flex justify-{{ $type === 'in' ? 'start' : 'end' }}">
    <div class="message message-{{ $type }}">
        {{ $message }}
    </div>
</div>