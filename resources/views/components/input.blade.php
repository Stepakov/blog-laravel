@props([
    'name',
    'label',
    'type' => 'text',
    'value' => null,
    'class' => 'form-control',
    ])

<label for="{{ $name }}" class="form-label">{{ $label }}</label>
<input
    name="{{ $name }}"
    type="{{ $type }}"
    class="{{ $class }}"
    id="{{ $name }}"
    placeholder={{ $label }}
    @if( $value ) value="{{ $value }}" @endif
>

@error( $name )
    <div class="alert alert-danger mt-3">
        {{ $message }}
    </div>
@enderror
