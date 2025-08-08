<div class="w-full grid lg:grid-cols-[300px_1fr] h-screen">
    <x-articles-sidebar :categories="$categories" :categoryNumber="$article->category->category_number" class="sticky"/>

    <div class="w-full h-full">
        <div class="py-2 px-4 w-full flex justify-end items-center gap-2">
            <div class="flex gap-1 items-center">
                <x-input-error for="status" />
                <x-button-status id="status" wire:model.defer="title" :status="$status" />
            </div>

            <x-button-save onclick="document.getElementById('article-edit-form').requestSubmit()">
                {{ __('Save') }}
            </x-button-save>

            <button type="button" class="px-1.5 py-1 focus:outline-none hover:bg-gray-100 rounded-md button-open-intern-sidebar-article">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg>
            </button>
        </div>
        <x-article-edit-form-section submit="save">
            <x-slot name="formA">
                <div class="flex flex-col items-between gap-2 p-4">
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="title" value="{{ __('Title') }}" />
                        <x-input id="title" type="text" class="mt-1 block w-full" wire:model.defer="title" />
                        <x-input-error for="title" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="slug" value="{{ __('Slug') }}" />
                        <x-input id="slug" type="text" class="mt-1 block w-full" wire:model.defer="slug" />
                        <x-input-error for="slug" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="category_id" value="{{ __('Category') }}" />
                        <x-select name="category_id" id="category_id" wire:model.defer="category_id" :options="$categories"
                            value-field="id" label-field="name" option-default="Select" />
                        <x-input-error for="category_id" class="mt-2" />
                    </div>
                    {{-- <div class="mt-10 w-full flex justify-center gap-2">
                        <x-button-save class="md:w-full md:flex md:justify-center">
                            {{ __('Save') }}
                        </x-button-save>
                    </div> --}}
                </div>
            </x-slot>

            <x-slot name="formB">
                <div id="content" wire:ignore wire:key="editor-{{ $article->id ?? 'new' }}" class="bg-white w-full flex-1 min-h-full p-4"></div>
                <input type="hidden" wire:model.defer="content" />
                <x-textarea-error for="content" />
            </x-slot>
        </x-article-form-section>
    </div>
</div>

@push('scripts')
    <script>
        window.livewireEditorContent = @json($content ? json_decode($content, true) : null);
    </script>
@endpush
