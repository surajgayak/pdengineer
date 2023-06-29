@props(['value','title','name','checked'])

    <label class="p-1 text-monospace badge  badge-pill  badge-light  border rounded">
        <input class="text-center check" type="checkbox"  value="{{$value}}" {{$checked ?? ''}} {{$attributes}} /> {{$title}}
    </label>
@push('css')
    <style>
        input.check {
            width: 10px!important;
            height: 10px!important;
            font-weight: normal!important;
        }
    </style>
@endpush
