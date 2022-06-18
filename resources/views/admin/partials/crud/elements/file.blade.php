@isset($edit)
    @php
        $name = $name ?? 'file';
        $keyDotted = remakeInputKeyDotted($name);
        $attributeKey = getLastFromExploded($keyDotted);
        $file = $edit->getAttribute($attributeKey);
        $editable = $editable ?? true;
        $title = $title ?? __('form.file.file-current');
    @endphp
	<?php /** @var $edit \App\Models\Model */ ?>
{{--    @if(getPathToImage($file))--}}
        <div class="form-group">
            <label class=" control-label">{{ $title }}</label>
            <div class="col">
                    <a href="{{'/storage/docs/' . $file}}" class=" bmd-label">
                        {{$file}}
                    </a>
            </div>
        </div>
{{--    @endif--}}
@endisset
