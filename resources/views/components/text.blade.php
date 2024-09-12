@props([
    'name',
    'label',
    'type' => 'text',
    'value' => null,
    ])

<label for="{{ $name }}" class="form-label">{{ $label }}</label>
<textarea
    name="{{ $name }}"
    class="form-control"
    id="{{ $name }}"
    placeholder={{ $label }}

>@if( $value ){{ $value }}@endif</textarea>

@error( $name )
    <div class="alert alert-danger mt-3">
        {{ $message }}
    </div>
@enderror
