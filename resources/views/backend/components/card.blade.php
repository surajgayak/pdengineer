@props(['header' => true, 'cardHeader', 'id', 'hasCreate' => false, 'route', 'hasBack' => false, 'ability'])

<div class="card">
    <div class="card-header justify-content-between">
        <h4>{{ $cardHeader }}</h4>
        @if ($header)
            @if ($hasCreate)
                @can($ability ?? '')
                    <a href='{{ $route }}' type="button" class="btn btn-primary">Create
                    </a>
                @endcan
            @endif
            @if ($hasBack)
                <a href='{{ $route }}' type="button" class="btn btn-primary">Back
                </a>
            @endif
    </div>
    @endif
    <div class="card-body">

        {{ $slot }}
    </div>
</div>
