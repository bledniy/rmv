<?php /** @var $sliderItem \App\Models\Slider\SliderItem */ ?>
<?php /** @var $sliderItemLang \App\Models\Slider\SliderItemLang */ ?>
@include('admin.sliders.partials.slides-create', ['slider' => $edit])

@isset($slides)
    <div data-sortable-container="true" data-table="slider_items">
        @foreach($slides as $sliderItem)
            <div class="draggable bordered b-top double-width pt-4 mb-4" data-sort="true"
                 data-id="{{ $sliderItem->id }}" data-deleteable-row="">
                <div class="row">
                    <div class="col-1">
                        @include('admin.partials.sort_handle')
                    </div>
                    <div class="col-10">
                        @include('admin.partials.crud.elements.image-upload-group',
                    ['name' => inputNamesManager($sliderItem)->getNameInputByKey('src'), 'edit' => $sliderItem, 'editable' => true,])
                    </div>
                    @include('admin.partials.delete_ajax_button', ['item' => $sliderItem,])
                </div>
                <div class="row">
                    <div class="col-md-3 d-none">
                        @include('admin.partials.crud.elements.active', ['name' => inputNamesManager($sliderItem)->getNameInputByKey('active'), 'edit' => $sliderItem])
                    </div>
{{--                    <div class="col-md-9">--}}
{{--                        @include('admin.sliders.elements.link')--}}
{{--                    </div>--}}
                </div>
                @if ($sliderItemLang = $sliderItem->lang)
                    <div class="row">
{{--                        <div class="col-12">--}}
{{--                            @include('admin.partials.crud.default', ['name' => inputNamesManager($sliderItemLang)->getNameInputByKey('name'), 'edit' => $sliderItemLang, 'title' => 'Название'])--}}
{{--                        </div>--}}
{{--                        <div class="col-md-12">--}}
{{--                            @include('admin.partials.crud.textarea.description', ['name' => inputNamesManager($sliderItemLang)->getNameInputByKey('description'), 'edit' => $sliderItemLang])--}}
{{--                        </div>--}}
{{--                        <div class="col-md-6">--}}
{{--                            @include('admin.partials.crud.textarea.excerpt', ['name' => inputNamesManager($sliderItemLang)->getNameInputByKey('excerpt'), 'edit' => $sliderItemLang, 'title' => 'Дополнительное описание'])--}}
{{--                        </div>--}}
                    </div>
                @endif
            </div>
        @endforeach
    </div>
@endisset