<?php /** @var $translate \App\Models\Translate\Translate */ ?>
@isset($translate)
    @if ($translate->isTypeTextarea())
        <textarea name="translate[{{ $translate->getKey() }}][value]"
                  cols="30" rows="6"
                  class="form-control"
                  @includeIf('admin.translate.includes.attributes')
                  maxlength="65000">{!! $translate->value !!}</textarea>
    @endif
@endisset