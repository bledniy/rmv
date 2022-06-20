<?php $options = json_decode($setting->details); ?>
<div id="{{ $setting->key }}" data-theme="{{ @$options->theme }}"
     data-language="{{ @$options->language }}"
     class="ace_editor min_height_400"
     >{{ \Arr::get($setting, 'value') }}</div>
<textarea name="@include('admin.settings.types.value-key')" id="{{ $setting->key }}_textarea"
          class="hidden">{{ \Arr::get($setting, 'value') }}</textarea>
{{-- END NOT EXISTS--}}
