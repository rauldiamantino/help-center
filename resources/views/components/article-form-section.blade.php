@props(['submit'])

<div {{ $attributes->merge(['class' => 'mx-auto w-full md:max-w-3xl bg-white rounded-lg']) }}>
    <form wire:submit="{{ $submit }}" class="space-y-10">
        <div class="p-4 space-y-8">
            {{ $form }}
        </div>

        @if (isset($actions))
            <div class="flex justify-end space-x-4 py-6 px-4 border-t border-gray-300">
                {{ $actions }}
            </div>
        @endif
    </form>
</div>
