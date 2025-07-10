<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Edit Article') }}
    </h2>
</x-slot>

<div>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

        {{-- @if (session()->has('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif --}}

        <x-article-form-section submit="save">
            <x-slot name="title">
                {{ __('Edit Article') }}
            </x-slot>

            <x-slot name="description">
                {{ __('Update the details of your article.') }}
            </x-slot>

            <x-slot name="form">
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
                    <x-label for="content" value="{{ __('Content') }}" />
                    <x-textarea rows="5" id="content" class="mt-1 block w-full" wire:model.defer="content" />
                    <x-textarea-error for="content" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="actions">
                <x-action-message class="me-3" on="saved">
                    {{ __('Saved.') }}
                </x-action-message>

                <x-link-button href="{{ route('dashboard.articles.index') }}" wire:navigate>
                    ← Back to List
                </x-link-button>
                <x-button>
                    {{ __('Save') }}
                </x-button>
            </x-slot>
        </x-article-form-section>
    </div>
</div>
