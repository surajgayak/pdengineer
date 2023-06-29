@props(['value', 'hasMultiElement' => false])
@if ($hasMultiElement)
    <td {{ $attributes->merge(['class' => '']) }} {{ $attributes }}>
        {{ $slot }}
    </td>
@else
    <td>{{ $value }}</td>
@endif
