@php
    $label ??= null;
    $name ??= null;
    $value ??= null;
    $placeholder ??= null;
@endphp

<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <textarea name="{{ $name }}" rows="4" class="form-control @error($name) is-invalid @enderror" placeholder="{{ $placeholder }}" id="{{ $name }}">{{old( $name, $value )}}</textarea>
</div>
<span class="text-danger">
    @error( $name )
    <small class="text-tiny">{{$message}}</small>
    @enderror
</span>

