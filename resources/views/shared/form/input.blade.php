@php
    $label ??= null;
    $class ??= 'form-control';
    $name ??= null;
    $value ??= null;
    $type ??= null;
    $role ??= null;
    $placeholder ??= null;
@endphp

<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <input id="{{ $name }}" name="{{ $name }}" value="{{old( $name, $value )}}" type="{{ $type }}" role="{{ $role }}"
        class=" {{ $class }} @error( $name ) is-invalid @enderror" id="{{ $name }}" 
        placeholder=" {{ $placeholder }}">
</div>
<span class="text-danger">
    @error( $name )
    <small class="text-tiny">{{$message}}</small>
    @enderror
</span>