<div class="w-full flex justify-between md:grid md:grid-cols-[300px_1fr] min-h-[calc(100vh-76px)]">
    <livewire:dashboard.articles.articles-sidebar :category-number="$category->category_number" />

    <div class="w-full">
        <div class="py-5 sm:px-6 lg:px-8 flex items-center justify-between">
            <x-button-back-redirect :route="'dashboard.articles.index'" :params="['categoryNumber' => null]">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>
            </x-button-back-redirect>

            <div class="py-2 px-4 w-full flex justify-end items-center gap-2">
                <x-button-save onclick="document.getElementById('category-edit-form').requestSubmit()">
                    {{ __('Save') }}
                </x-button-save>
            </div>
        </div>

        <x-category-edit-form-section submit="save">
            <x-slot name="form">
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="name" value="{{ __('Name') }}" />
                    <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" autofocus />
                    <x-input-error for="name" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-label for="slug" value="{{ __('Slug') }}" />
                    <x-input id="slug" type="text" class="mt-1 block w-full" wire:model.defer="slug" />
                    <x-input-error for="slug" class="mt-2" />
                </div>
            </x-slot>
        </x-category-edit-form-section>
    </div>
</div>

@push('scripts')
    <script>
        function initSlug() {
            const categoryName = document.querySelector('#name')
            const categorySlug = document.querySelector('#slug')

            if (! categoryName || ! categorySlug) {
                return
            }

            categoryName.oninput = null
            categoryName.addEventListener('input', function() {
                let slug = this.value
                    .toLowerCase()
                    .normalize('NFD')
                    .replace(/[\u0300-\u036f]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/[^\w\-]+/g, '')
                    .replace(/\-\-+/g, '-')
                    .replace(/^-+/, '')
                    .replace(/-+$/, '')

                categorySlug.value = slug
                categorySlug.dispatchEvent(new Event('input'))
            })
        }

        initSlug()
    </script>
@endpush
