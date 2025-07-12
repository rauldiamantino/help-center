@props(['status'])

@php
$classes = 'bg-gray-200 text-gray-600 hover:bg-gray-300';
$statusName = 'Draft';

if ($status == 1) {
    $classes = 'bg-green-100 text-green-700 hover:bg-green-200';
    $statusName = 'Published';
}
@endphp

<button type="button" wire:click="$set('status', {{ $status ? 0 : 1 }})"
    class="mt-2 px-4 py-2 rounded-md text-sm font-semibold transition-colors duration-200 {{ $classes }}">
    {{ $status ? 'Published' : 'Draft' }}
</button>
