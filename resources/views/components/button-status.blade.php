@props(['status'])

@php
    $isPublished = $status == 1;

    $classes = $isPublished
        ? 'bg-green-100 text-green-700 hover:bg-green-200'
        : 'bg-gray-200 text-gray-600 hover:bg-gray-300';

    $statusName = $isPublished ? 'Published' : 'Draft';

    $newStatus = $isPublished ? 3 : 1;
@endphp

<button type="button" wire:click="$set('status', {{ $newStatus }})"
    class="mt-2 px-4 py-2 rounded-md text-sm font-semibold transition-colors duration-200 {{ $classes }}">
    {{ $statusName }}
</button>
