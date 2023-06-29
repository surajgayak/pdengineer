@props(['label', 'required' => false,'name'])

<div class="form-group">
    <label for="">{{ $label }}
        @if ($required)
            <span class="text-danger">*</span>
            @error($name)
                <span class="font- text-danger ml-1" style="font-size: 12px;"> [ {{ $message }} ]</span>
            @enderror
        @endif
    </label>
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="fas fa-angle-right"></i>
            </div>
        </div>
        <select class="form-control @error($name) is-invalid @enderror" id="inputGroupSelect04" name="{{$name}}" {{$attributes}}>
            <option selected>Choose...</option>
            {{ $slot }}
        </select>
    </div>
</div>
