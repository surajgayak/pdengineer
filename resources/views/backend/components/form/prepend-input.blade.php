@props(['label', 'id','type', 'name','value', 'required' => false, 'hasIcon' => true, 'iconName', 'hasSvg' => false, 'svg'])
<div class="form-group">
    <label>
        {{ $label }}</span>
        @if ($required)
            <span class="text-danger">*</span>
            @error($name)
                <span class="font- text-danger ml-1" style="font-size: 12px;"> [ {{ $message }} ]</span>
            @enderror
        @endif
    </label>
    <div   class="input-group">
        <div id="{{$id ?? ''}}" class="input-group-prepend">
            @if ($hasIcon)
                <div class="input-group-text">
                    <i class="fas fa-{{ $iconName }}"></i>
                </div>
            @endif
            @if ($hasSvg)
                <div class="input-group-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-mail">
                        <path d="{{ $svg }}">
                        </path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                </div>
            @endif
        </div>
        <input type="{{ $type }}" class="form-control @error($name) is-invalid @enderror" name="{{ $name }}"
            value="{{ $value ?? old($name) }}" {{ $attributes }}>
    </div>
</div>
