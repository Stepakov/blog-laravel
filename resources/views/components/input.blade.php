@props([
    'name',
    'label',
    'type' => 'text',
    'value' => null,
    ])

<label for="{{ $name }}" class="form-label">{{ $label }}</label>
<input
    name="{{ $name }}"
    type="{{ $type }}"
    class="form-control"
    id="{{ $name }}"
    placeholder={{ $label }}
    @if( $value ) value="{{ $value }}" @endif
>

@error( $name )
    <div class="alert alert-danger mt-3">
        {{ $message }}
    </div>
@enderror
