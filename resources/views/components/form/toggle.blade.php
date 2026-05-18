@props(['label' => null, 'name' => null])

@php
    $model = $attributes->get('wire:model');
    $field = $name ?? $model;
@endphp

<label class="app-toggle">
    <input type="checkbox" {{ $attributes }}>
    <span class="slider"></span>
    <span class="text-toggle">{{ $label }}</span>
</label>