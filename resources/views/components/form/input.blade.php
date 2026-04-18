@props([
    'label' => null,
    'name' => null,
    'type' => 'text',
    'value' => null,
    'placeholder' => '',
])

@php
    $model = $attributes->get('wire:model')
            ?? $attributes->get('wire:model.defer')
            ?? $attributes->get('wire:model.live');

    $field = $name ?? $model;
    $error = $field && $errors->has($field);
@endphp

<div class="app-form-group {{ $error ? 'is-error' : '' }}">
    @if($label)
        <label for="{{ $field }}">{{ $label }}</label>
    @endif

    <input
        type="{{ $type }}"
        id="{{ $field }}"
        name="{{ $field }}"
        value="{{ old($field, $value) }}"
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge(['class' => 'app-form-control']) }}
    >

    @if($field)
        @error($field)
            <small class="app-error-text">{{ $message }}</small>
        @enderror
    @endif
</div>