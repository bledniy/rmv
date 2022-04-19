<?php /** @var $slider \App\Models\Slider\Slider */ ?>
<?php /** @var $sliderItemEmpty \App\Models\Slider\SliderItem */ ?>
<div class="mb-5">
    {{-- <div class="row">
         <div class="col-1">
             --}}{{--                    @include('admin.partials.sort_handle')--}}{{--
         </div>
         <div class="col-11">
             @include('admin.partials.crud.elements.image-upload-group',
         ['name' => inputNamesManager($sliderItemEmpty-)>getNameInputByKey('src'), 'editable' => false,])
         </div>
     </div>
     <div class="row">
         <div class="col-md-3">
             {!! ElementsHelper::active(['name' => inputNamesManager($sliderItemEmpty-)>getNameInputByKey('active')]) !!}
         </div>
         <div class="col-md-9">
             @include('admin.sliders.elements.link', ['sliderItem' => $sliderItemEmpty])
         </div>
     </div>
     @if ($sliderItemLangEmpty)
         <div class="row">
             <div class="col-md-6">
                 @include('admin.partials.crud.textarea.description', ['name' => inputNamesManager($sliderItemLangEmpty)->getNameInputByKey('description'), 'edit' => $sliderItemLangEmpty])
             </div>
             <div class="col-md-6">
                 @include('admin.partials.crud.textarea.except', ['name' => inputNamesManager($sliderItemLangEmpty)->getNameInputByKey('description'), 'edit' => $sliderItemLangEmpty])
             </div>
         </div>
     @endif--}}
    <div class="text-center">
        <button class="btn btn-primary" id="sliderItemsCreate"
                data-url="{{ route('admin.sliders.store-item', $edit->id) }}">
            <i class="fa fa-plus" aria-hidden="true"></i>
            Добавить слайд
        </button>
    </div>
</div>
<script defer>
    $(document).ready(function () {
        $(document).on('click', '#sliderItemsCreate', function (e) {
            e.preventDefault();
            let $this = $(this);
            let url = $this.data('url');
            if (url) {
                $.post(url, function (res) {
                    messageResponse(res);
                    if (res.status === 'success') {
                        $this.parents('form').submit();
                    }
                })
            }
        })
    });
</script>
