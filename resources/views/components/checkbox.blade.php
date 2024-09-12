@props([
    'name',
    'label',
    'value' => null,
    'checked' => null,
    ])

<div class="form-check">
    <input
        name="{{ $name }}"
        class="form-check-input"
        type="checkbox"
        id="{{ $name }}"
        @if( $value || $checked ) checked @endif
    >
    <label class="form-check-label" for="{{ $name }}">
        {{ $label }}
    </label>
</div>
