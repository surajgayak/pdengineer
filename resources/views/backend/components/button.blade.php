@props(['name', 'btnType', 'hasLink' => false, 'route', 'disabled' => true])
@if ($hasLink)
    <a href="{{ $route }}" class="btn btn-{{ $btnType }}">{{ $name }}</a>
@else
    <button class="btn btn-{{ $btnType }} px-4" type="submit"
        {{$attributes}}>{{ $name }}</button>
@endif
