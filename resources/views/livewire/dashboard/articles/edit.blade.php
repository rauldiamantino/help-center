<div class="w-full grid grid-cols-[300px_1fr] min-h-[600px]">
    <x-articles-sidebar :categories="$categories" :categoryNumber="$article->category->category_number" />

    <div class="overflow-x-auto w-full py-10 sm:px-6 lg:px-8">
        <x-article-form-section submit="save">
            <x-slot name="form">
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="status" value="{{ __('Status') }}" />
                    <x-button-status id="status" wire:model.defer="title" :status="$status"/>
                    <x-input-error for="status" class="mt-2" />
                </div>



                <div class="col-span-6 sm:col-span-4">
                    <x-label for="title" value="{{ __('Title') }}" />
                    <x-input id="title" type="text" class="mt-1 block w-full" wire:model.defer="title" />
                    <x-input-error for="title" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="category_id" value="{{ __('Category') }}" />
                    <x-select name="category_id" id="category_id" wire:model.defer="category_id" :options="$categories"
                        value-field="id" label-field="name" option-default="Select" />
                    <x-input-error for="category_id" class="mt-2" />
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

                <x-link-button
                    href="{{ route('dashboard.articles.index', ['categoryNumber' => $article->category->category_number]) }}"
                    wire:navigate>
                    ← Back to List
                </x-link-button>

                <x-button>
                    {{ __('Save') }}
                </x-button>
            </x-slot>
        </x-article-form-section>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 mt-10">
            <div class="bg-white p-6 rounded flex justify-between items-center border border-gray-300">
                <div>
                    <h3 class="text-sm font-medium text-gray-800">Danger zone</h3>
                    <p class="text-sm text-gray-500 mt-1">Permanently delete this article. This action cannot be undone.
                    </p>
                </div>
                <x-danger-button wire:click="destroy" wire:loading.attr="disabled">
                    Delete Article
                </x-danger-button>
            </div>
        </div>
    </div>
</div>
