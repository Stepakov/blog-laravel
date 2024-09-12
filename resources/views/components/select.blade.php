@props([
    'name',
    'label',
    'options',
    'items',
    'value' => null,
    ])

{{--@dd( $value )--}}

<label for="{{ $name }}" class="form-label">{{ $label }}</label>
<select
    name="{{ $name }}"
    class="form-control"
    id="{{ $name }}"
>
    @foreach( $options as $key => $val )
        <option
            @if( $value && $key == $value ) selected @endif
            value="{{ $key }}">{{ $val }}</option>
    @endforeach
</select>

@error( $name )
    <div class="alert alert-danger mt-3">
        {{ $message }}
    </div>
@enderror
