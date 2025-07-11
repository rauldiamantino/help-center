@props([
    'disabled' => false,
    'options' => [],
    'selected' => null,
    'valueField' => 'id',
    'labelField' => 'name',
    'optionDefault' => 'Select',
])

<select
    {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full']) !!}
>
    <option value="" class="text-gray-400">{{ $optionDefault }}</option>

    @foreach ($options as $option)
        <option value="{{ $option[$valueField] ?? $option->{$valueField} }}"
            @if(old($attributes->get('name')) == ($option[$valueField] ?? $option->{$valueField}))
                selected
            @elseif($selected == ($option[$valueField] ?? $option->{$valueField}))
                selected
            @endif
        >
            {{ $option[$labelField] ?? $option->{$labelField} }}
        </option>
    @endforeach
</select>
