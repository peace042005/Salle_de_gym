@php
    $label ??= null;
    $name ??= null;
    $value ??= null;
@endphp

<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <input name="{{ $name }}" value="{{old( $name, $value )}}" type="file"
        class="form-control @error( $name ) is-invalid @enderror" id="{{ $name }}">
</div>
<span class="text-danger">
    @error( $name )
    <small class="text-tiny">{{$message}}</small>
    @enderror
</span>