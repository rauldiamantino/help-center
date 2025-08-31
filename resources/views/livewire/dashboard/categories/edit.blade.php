<div class="w-full grid md:grid-cols-[300px_1fr] min-h-[600px]">
    <x-categories-sidebar :categories="$categories" :categoryNumber="$category->category_number" />

    <div class="overflow-x-auto w-full py-10 sm:px-6 lg:px-8">
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

            <x-slot name="actions">
                <div class="flex gap-1 items-center">
                    <x-input-error for="status" />
                    <x-button-status id="status" wire:model.defer="status" :status="$status" />
                </div>

                <x-button-save  wire:click="save">
                    {{ __('Save') }}
                </x-button-save>
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
