<div class="w-full grid grid-cols-[300px_1fr] min-h-[600px]">
    <x-articles-sidebar :categories="$categories" :categoryNumber="$categoryNumber" />

    <div class="overflow-x-auto w-full py-10 sm:px-6 lg:px-8">
        <x-article-form-section submit="save">
            <x-slot name="form">
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="title" value="{{ __('Title') }}" />
                    <x-input id="title" type="text" class="mt-1 block w-full" wire:model.defer="title" />
                    <x-input-error for="title" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-label for="category_id" value="{{ __('Category') }}" />
                    <x-select name="category_id" id="category_id" wire:model.defer="category_id" :options="$categoriesSelect"
                        value-field="id" label-field="name" option-default="Select" disabled="true" />
                    <x-input-error for="category_id" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-label for="slug" value="{{ __('Slug') }}" />
                    <x-input id="slug" type="text" class="mt-1 block w-full" wire:model.defer="slug" />
                    <x-input-error for="slug" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="actions">
                <x-button-save>
                    {{ __('Save') }}
                </x-button-save>
            </x-slot>
        </x-article-form-section>
    </div>
</div>
