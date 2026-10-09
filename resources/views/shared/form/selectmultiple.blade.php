@php
    $name ??= '';
    $value ??= '';
    $label ??= ucfirst($name);
    $selectMultipleOptions;
    $placeholder ??= 'Vous pouvez choisir plusieurs options...';
@endphp

<div class="form-group">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <select id="{{ $name }}" name="{{ $name }}[]" multiple="multiple" class="multi-select @error($name) is-invalid @enderror">
        <option value="" disabled>{{ $placeholder }}</option>
        @foreach ($selectMultipleOptions as $k => $v)
            <option @selected($value->contains($k)) value="{{ $k }}">{{ $v }}</option>
        @endforeach
    </select>
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>