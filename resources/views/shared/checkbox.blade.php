@php
$label ??= ucfirst($name);
$type ??= null;
$class ??= null;
$name ??= '';
$value ??= '';
    
@endphp

<div @class(["form-check form-switch", $class])>
    <input type="hidden" value=0 name="{{ $name }}">
    <input @checked(old($name, $value ?? false)) type="checkbox" name="{{ $name }}" class="form-check-input @error($name) is-invalid @enderror" role="switch" id="">
    <label for="{{ $name }}">{{ $label }}</label>
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>