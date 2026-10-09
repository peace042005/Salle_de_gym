@php
$value ??= false;
$name ??= null;
@endphp

<div class="form-check form-switch">
  <input type="hidden" value="0" name="{{$name}}">
  <input type="checkbox" name="{{$name}}" value="1" @checked(old($name, $value)) class="form-check-input @error($name) is-invalid @enderror" role="switch">
  <label id="{{$name}}" for="{{$name}}" class="form-check-label">{{$label}}</label>
  @error($name)
  <div class="invalid-feedback">{{$message}}</div>
  @enderror
</div>