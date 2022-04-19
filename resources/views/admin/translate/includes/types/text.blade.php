<?php /** @var $translate \App\Models\Translate\Translate */ ?>
@isset($translate)
    @if ($translate->isTypeText())
        <input type="text"
               name="translate[{{$translate->getKey()}}][value]"
               value="{{$translate->value}}"
               @includeIf('admin.translate.includes.attributes')
               class="form-control">
    @endif
@endisset