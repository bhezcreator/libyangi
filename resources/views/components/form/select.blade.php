@props([
    'label' => null,
    'name' => null,
    'options' => [],
    'placeholder' => 'Sélectionner...',
])

@php
    $model = $attributes->get('wire:model');
    $field = $name ?? $model;
@endphp

<div class="app-form-group {{ $errors->has($field) ? 'is-error' : '' }}">
    @if($label)
        <label for="{{ $field }}">{{ $label }}</label>
    @endif

    <select
        id="{{ $field }}"
        name="{{ $field }}"
        {{ $attributes->merge(['class' => 'app-form-control']) }}
    >
        <option value="">{{ $placeholder }}</option>

        @foreach($options as $key => $value)
            <option value="{{ $key }}">{{ $value }}</option>
        @endforeach
    </select>

    @error($field)
        <small class="app-error-text">{{ $message }}</small>
    @enderror
</div>