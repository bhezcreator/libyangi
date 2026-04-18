@props(['label' => null, 'name' => null])

@php
    $model = $attributes->get('wire:model');
    $field = $name ?? $model;
@endphp

<label class="app-checkbox">
    <input type="checkbox" {{ $attributes }}>
    <span class="checkmark"></span>
    {{ $label }}
</label>