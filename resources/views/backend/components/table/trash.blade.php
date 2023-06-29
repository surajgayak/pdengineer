@props(['route'])
<a href="{{ $route }}" class="text-decoration-none" data-toggle="confirmation" data-title="Are You Sure?" data-singleton="true" data-popout="true">
    <i title="Delete" {{ $attributes->merge(['class' => '
        fas fa-trash-alt text-danger']) }} style="font-size:15px;"></i>
</a>
