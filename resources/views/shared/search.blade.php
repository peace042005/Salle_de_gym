@php
    $action;
    $actionParam ??= null;
    $inputClass ??= 'form-control';
    $buttonClass ??= 'btn btn-primary';
@endphp

<form method="GET" action="{{ route($action, $actionParam) }}" class="d-flex" role="search">
    <input name="search" class="{{ $inputClass }}" type="search" placeholder="Recherchez..." aria-label="Search" aria-describedby="search-input">
    <button class="{{ $buttonClass }}" type="submit" id="search-input">Rechercher</button>
</form>