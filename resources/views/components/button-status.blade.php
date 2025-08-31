@props(['status'])

@php
    $isPublished = $status == 1;

    $classes = $isPublished
        ? 'bg-green-100 text-green-700 hover:bg-green-200'
        : 'bg-orange-100 text-orange-700 hover:bg-orange-200';

    $statusName = $isPublished ? 'Published' : 'Draft';
    $newStatus = $isPublished ? 3 : 1;
@endphp

<button type="button" wire:click="$set('status', {{ $newStatus }})"
    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-none disabled:opacity-50 transition ease-in-out duration-150 {{ $classes }}">
    {{ $statusName }}
</button>
