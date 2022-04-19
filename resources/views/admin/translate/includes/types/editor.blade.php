<?php /** @var $translate \App\Models\Translate\Translate */ ?>
@isset($translate)
    @if ($translate->isTypeEditor())
        <textarea name="translate[{{ $translate->getKey() }}][value]"
                  cols="30" rows="6"
                  data-send-no-disable="true"
                  @includeIf('admin.translate.includes.attributes')
                  class="form-control ckeditor-default"
                  maxlength="65000">{!! $translate->value !!}</textarea>
    @endif
@endisset