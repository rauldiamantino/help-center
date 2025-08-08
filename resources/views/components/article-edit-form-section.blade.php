@props(['submit'])
<div {{ $attributes->merge(['class' => 'relative w-full h-full']) }}>
    <form id="article-edit-form" wire:submit="{{ $submit }}" class="flex flex-col md:flex-row gap-10">
        <div class="rounded-md absolute z-40 top-4 right-6 flex flex-col justify-between max-w-72 h-[80vh] bg-gray-50 border border-gray-150 overflow-y-auto transition-opacity duration-100 opacity-0 invisible intern-sidebar-article">
            {{ $formA }}

            <div class="p-4 md:max-w-3xl mx-auto mt-20">
                <div class="bg-white p-6 rounded flex flex-col justify-center items-between gap-4 border border-gray-300">
                    <div>
                        <h3 class="text-sm font-medium text-gray-800">Danger zone</h3>
                        <p class="text-sm text-gray-500 mt-1">Permanently delete this article. This action cannot be undone.
                        </p>
                    </div>
                    <x-danger-button wire:click="destroy" wire:loading.attr="disabled">
                        Delete
                    </x-danger-button>
                </div>
            </div>
        </div>

        <div class="w-full h-[calc(100vh-65px)] overflow-y-auto flex flex-col">
            {{ $formB }}
        </div>
    </form>
</div>
