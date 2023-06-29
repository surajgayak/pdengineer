@props(['label', 'name', 'hasIcon' => true, 'iconName'])
<div class="form-group">
    <label>{{ $label }}</label>
    @if ($hasIcon)
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text" style="height:auto;">
                    <i class="fas fa-{{ $iconName }}"></i>
                </div>
            </div>
            <textarea {{ $attributes->merge(['class' => 'form-control']) }} name="{{ $name }}" placeholder="Something..."
                {{ $attributes }}>
            {{ $slot }}
        </textarea>
        </div>
    @endif
    @if (!$hasIcon)
        <textarea {{ $attributes->merge(['class' => 'form-control']) }} name="{{ $name }}" rows="12" cols="50" resize='true'
            placeholder="Something ..." {{ $attributes }}>
        {{ $slot }}
    </textarea>
    @endif



</div>
