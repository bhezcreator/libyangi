@props(['label' => null])

<label class="app-toggle">
    <input type="checkbox" {{ $attributes }}>
    <span class="slider"></span>
    <span class="text">{{ $label }}</span>
</label>