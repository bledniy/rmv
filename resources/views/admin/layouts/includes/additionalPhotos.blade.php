<?php /** @var $image \App\Models\Image */ ?>
<?php /** @var $edit \App\Models\Model */ ?>
<div class="form-group">
    <label for="images" class="col-sm-2 control-label">@lang('modules._.tabs.photos')</label>
    <div class="col-sm-6">
        <input type="file" name="images[]" id="images" class="filestyle" data-buttonText="@lang('form.image.choose-image')"
               data-placeholder="@lang('form.image.no-file')" accept="image/*" multiple>
    </div>
</div>
<div data-sortable-container="true" data-table="{{$images_table ?? 'images'}}">
    @if(isset($photosList) AND $photosList)
        @foreach($photosList as $num => $image)
            @if ($image->image AND storageFileExists($image->image))
                @php
                    $photoSrc = getPathToImage($image->image);
                    $primaryId = isset($edit->id) ? 'data-primary-id="' . $edit->id .'"' : '';
                    $images_table = $images_table ?? 'images' ;
                    $directory = $directory ?? (isset($edit) ? $edit->getTable() : false) ?: $images_table;
                @endphp
                <div class="image-actions draggable" data-sort="true" data-id="{{ $image->id }}" data-image-actions="">
                    <a href="{{ imgPathOriginal($photoSrc) }}" class="fancy" data-fancybox="additional_images">
                        <img src="{{ $photoSrc }}?{{storageFilemtime($image->image)}}"
                             class="img-fluid croppable deleteable" width="150"
                             data-image-id="{{ $image->id ?? '' }}"
                             data-image-table="{{ $images_table }}"
                             data-image-directory="{{ $directory }}"
                            {!! $primaryId !!}>
                        @include('admin.partials.sort_handle')
                    </a>
                </div>
            @endif
        @endforeach
    @endif
</div>