<?php /** @var $sliderItem \App\Models\Slider\SliderItem */ ?>
@include('admin.partials.crud.default',
['name' => inputNamesManager($sliderItem)->getNameInputByKey('link'), 'edit' => $sliderItem, 'title' => 'Ссылка'])