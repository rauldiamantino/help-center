<div class="w-full grid md:grid-cols-[300px_1fr] min-h-[600px]">
    <x-articles-sidebar :categories="$categories" :categoryNumber="$categoryNumber" />

    <div class="w-full">
        <div class="mb-4 px-2 flex items-center justify-between">
            <x-button-back-redirect :route="'dashboard.articles.index'" :params="['categoryNumber' => null]">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>
            </x-button-back-redirect>

            <div class="py-2 px-4 w-full flex justify-end items-center gap-2">
                <div class="flex gap-1 items-center">
                    <x-input-error for="status" />
                    <x-button-status id="status" wire:model.defer="status" :status="$status" />
                </div>
                <x-button-save onclick="document.getElementById('article-create-form').requestSubmit()">
                    {{ __('Save') }}
                </x-button-save>
            </div>
        </div>

        <x-article-form-section submit="save">
            <x-slot name="form">
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="title" value="{{ __('Title') }}" />
                    <x-input id="title" type="text" class="mt-1 block w-full" wire:model.defer="title" autofocus />
                    <x-input-error for="title" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-label for="category_id" value="{{ __('Category') }}" />
                    <x-select name="category_id" id="category_id" wire:model.defer="category_id" :options="$categoriesSelect"
                        value-field="id" label-field="name" option-default="Select" />
                    <x-input-error for="category_id" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-label for="slug" value="{{ __('Slug') }}" />
                    <x-input id="slug" type="text" class="mt-1 block w-full" wire:model.defer="slug" />
                    <x-input-error for="slug" class="mt-2" />
                </div>
            </x-slot>

            {{-- <x-slot name="actions">
                <x-button-save>
                    {{ __('Save') }}
                </x-button-save>
            </x-slot> --}}
        </x-article-form-section>
    </div>
</div>

@push('scripts')
    <script>
        function initSlug() {
            const articleTitle = document.querySelector('#title')
            const articleSlug = document.querySelector('#slug')

            if (! articleTitle || ! articleSlug) {
                return
            }

            articleTitle.oninput = null
            articleTitle.addEventListener('input', function() {
                let slug = this.value
                    .toLowerCase()
                    .normalize('NFD')
                    .replace(/[\u0300-\u036f]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/[^\w\-]+/g, '')
                    .replace(/\-\-+/g, '-')
                    .replace(/^-+/, '')
                    .replace(/-+$/, '')

                articleSlug.value = slug
                articleSlug.dispatchEvent(new Event('input'))
            })
        }

        initSlug()
    </script>
@endpush
