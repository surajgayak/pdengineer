@props(['label','type','name'])
<div class="form-group">
    <label>{{$label}}</label>
    {{-- <input type="text" class="form-control form-control-sm"> --}}
    <input type="text" class="form-control form-control-sm" name="{{ $name }}"
    value="{{ $value ?? old($name) }}" {{ $attributes }}>
  </div>
