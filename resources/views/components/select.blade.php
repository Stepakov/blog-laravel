@props([
    'name',
    'label',
    'options',
    'items',
    'value' => null,
    'multiple' => null,
    ])

{{--@dd( $value )--}}

<label for="{{ $name }}" class="form-label">{{ $label }}</label>
<select
    name="{{ $name }}"
    class="form-control"
    id="{{ $name }}"
    @if( $multiple ) multiple @endif
>
    @foreach( $options as $key => $val )
        <option
            @if( $value && is_array( $value ) && in_array( $key, $value ) ) selected @endif
            @if( $value && !is_array( $value ) && $key == $value ) selected @endif
            value="{{ $key }}">{{ $val }}</option>
    @endforeach
</select>

@error( $name )
    <div class="alert alert-danger mt-3">
        {{ $message }}
    </div>
@enderror
