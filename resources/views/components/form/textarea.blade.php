@props([
    'label' => null,
    'name' => null,
    'rows' => 4,
    'placeholder' => '',
])

@php
    $model = $attributes->get('wire:model');
    $field = $name ?? $model;
@endphp

<div class="app-form-group {{ $errors->has($field) ? 'is-error' : '' }}">
    @if($label)
        <label for="{{ $field }}">{{ $label }}</label>
    @endif

    <textarea
        id="{{ $field }}"
        name="{{ $field }}"
        rows="{{ $rows }}"
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge(['class' => 'app-form-control']) }}
    ></textarea>

    @error($field)
        <small class="app-error-text">{{ $message }}</small>
    @enderror
</div>