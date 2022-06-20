<?php /** @var $image \App\Models\Image */ ?>
<div class="modal fade" id="cropWrapperModal" tabindex="-1" role="dialog">
    <div class="modal-dialog m-5" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center" id="myLargeModalLabel">{{ __('actions.cropper.image-edit') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-9">
                        @if(isset($image) )
                            <div class="img-container">
                                @php
                                    $photoSrc = getPathToImage(imgPathOriginal( Arr::get($image, 'src')));
                                    $primaryId = isset($primary_id) ? 'data-primary-id="' . $primary_id .'"' : '';
                                @endphp
                                <img src="{{ $photoSrc }}?{{ time() }}" class="" id="image-main"
                                     data-image-id="{{ $image['id'] }}"
                                     data-image-table="{{$photo_table}}"
                                     data-image-directory="{{ $directory }}"
                                        {!! $primaryId !!}>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-3">
                        <div class="docs-preview clearfix">
                            <div class="img-preview preview-lg"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group"></div>
                <div class="row" id="actions">
                    <div class="col-md-9 docs-buttons">
                        <!-- <h3>Toolbar:</h3> -->
                        <button class="crop btn btn-danger" type="button" data-method="getCroppedCanvas"
                                data-param="save">{{ __('actions.cropper.crop-and-save') }}</button>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" data-method="setDragMode" data-option="move"
                                    title="Move">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.setDragMode(&quot;move&quot;)">
              <i class="fa fa-arrows"></i>
            </span>
                            </button>
                            <button type="button" class="btn btn-primary" data-method="setDragMode" data-option="crop"
                                    title="Crop">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.setDragMode(&quot;crop&quot;)">
              <span class="fa fa-crop"></span>
            </span>
                            </button>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1"
                                    title="Zoom In">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.zoom(0.1)">
              <span class="fa fa-search-plus"></span>
            </span>
                            </button>
                            <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1"
                                    title="Zoom Out">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.zoom(-0.1)">
              <span class="fa fa-search-minus"></span>
            </span>
                            </button>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" data-method="move" data-option="-10"
                                    data-second-option="0" title="Move Left">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.move(-10, 0)">
              <span class="fa fa-arrow-left"></span>
            </span>
                            </button>
                            <button type="button" class="btn btn-primary" data-method="move" data-option="10"
                                    data-second-option="0"
                                    title="Move Right">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.move(10, 0)">
              <span class="fa fa-arrow-right"></span>
            </span>
                            </button>
                            <button type="button" class="btn btn-primary" data-method="move" data-option="0"
                                    data-second-option="-10" title="Move Up">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.move(0, -10)">
              <span class="fa fa-arrow-up"></span>
            </span>
                            </button>
                            <button type="button" class="btn btn-primary" data-method="move" data-option="0"
                                    data-second-option="10"
                                    title="Move Down">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.move(0, 10)">
              <span class="fa fa-arrow-down"></span>
            </span>
                            </button>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" data-method="crop" title="Crop">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.crop()">
              <span class="fa fa-check"></span>
            </span>
                            </button>
                            <button type="button" class="btn btn-primary" data-method="clear" title="Clear">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.clear()">
              <i class="fa fa-times"></i>
            </span>
                            </button>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" data-method="disable" title="Disable">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.disable()">
              <span class="fa fa-lock"></span>
            </span>
                            </button>
                            <button type="button" class="btn btn-primary" data-method="enable" title="Enable">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.enable()">
              <span class="fa fa-unlock"></span>
            </span>
                            </button>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" data-method="reset" title="Reset">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.reset()">
              <i class="fa fa-refresh" aria-hidden="true"></i>
            </span>
                            </button>
                            <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
                                <input type="file" class="sr-only" id="inputImage" name="file" accept="image/*">
                                <span class="docs-tooltip">
              <span class="fa fa-upload"></span>
            </span>
                            </label>
                            <button type="button" class="btn btn-primary" data-method="destroy" title="Destroy">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.destroy()">
              <span class="fa fa-power-off"></span>
            </span>
                            </button>
                        </div>
                        <div class="btn-group btn-group-crop">
                            <button type="button" class="btn btn-success" data-method="getCroppedCanvas"
                                    data-option="{ &quot;maxWidth&quot;: 4096, &quot;maxHeight&quot;: 4096 }">
            <span class="docs-tooltip" data-toggle="tooltip"
                  title="cropper.getCroppedCanvas({ maxWidth: 4096, maxHeight: 4096 })">{{ __('actions.cropper.download-edited') }} </span>
                            </button>
                        </div>
                        <button type="button" class="btn btn-secondary" data-method="moveTo" data-option="0">
                            <span class="docs-tooltip" data-toggle="tooltip"
                                  title="cropper.moveTo(0)">Move to [0,0]</span>
                        </button>
                        <button type="button" class="btn btn-secondary" data-method="zoomTo" data-option="1">
                            <span class="docs-tooltip" data-toggle="tooltip"
                                  title="cropper.zoomTo(1)">Zoom to 100%</span>
                        </button>
                        <button type="button" class="btn btn-secondary" data-method="getData" data-option=""
                                data-target="#putData">
          <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title=""
                data-original-title="$().cropper(&quot;getData&quot;)">Get Data</span>
                        </button>
                        <button type="button" class="btn btn-secondary" data-method="setData" data-target="#putData">
          <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title=""
                data-original-title="$().cropper(&quot;setData&quot;, data)">Set Data</span>
                        </button>
                        <textarea type="text" class="form-control" id="putData" rows="1"
                                  placeholder="Get data to here or set data with this value"></textarea>
                    </div><!-- /.docs-buttons -->
                    <div class="col-md-3 docs-toggles">
                        <!-- <h3>Toggles:</h3> -->
                        <div class="form-group">
                            <div class="docs-data">
                                <label class="input-group-text" for="dataWidth">Width px</label>
                                <input type="text" class="form-control" id="dataWidth" placeholder="width">
                                <span class="input-group-append"></span>
                                <label class="input-group-text" for="dataHeight">Height px</label>
                                <input type="text" class="form-control" id="dataHeight" placeholder="height">
                                <span class="input-group-append"></span>
                            </div>
                        </div>
                        <div class="btn-group d-flex flex-nowrap" data-toggle="buttons">
                            <label class="btn btn-primary active">
                                <input type="radio" class="sr-only" id="aspectRatio1" name="aspectRatio"
                                       value="1.7777777777777777">
                                <span class="docs-tooltip" data-toggle="tooltip"
                                      title="Соотношение сторон: 16 / 9">16:9</span>
                            </label>
                            <label class="btn btn-primary">
                                <input type="radio" class="sr-only" id="aspectRatio2" name="aspectRatio"
                                       value="1.3333333333333333">
                                <span class="docs-tooltip" data-toggle="tooltip"
                                      title="Соотношение сторон: 4 / 3">4:3</span>
                            </label>
                            <label class="btn btn-primary">
                                <input type="radio" class="sr-only" id="aspectRatio3" name="aspectRatio" value="1">
                                <span class="docs-tooltip" data-toggle="tooltip"
                                      title="Соотношение сторон: 1 / 1">1:1</span>
                            </label>
                            <label class="btn btn-primary">
                                <input type="radio" class="sr-only" id="aspectRatio4" name="aspectRatio"
                                       value="0.6666666666666666">
                                <span class="docs-tooltip" data-toggle="tooltip"
                                      title="Соотношение сторон: 2 / 3">2:3</span>
                            </label>
                            <label class="btn btn-primary">
                                <input type="radio" class="sr-only" id="aspectRatio5" name="aspectRatio" value="NaN">
                                <span class="docs-tooltip" data-toggle="tooltip" title="Соотношение сторон: свободное">Free</span>
                            </label>
                        </div>
                        <div class="dropdown dropup docs-options">
                        </div><!-- /.dropdown -->
                    </div><!-- /.docs-toggles -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Show the cropped image in modal -->
<div class="modal fade docs-cropped" id="getCroppedCanvasModal" role="dialog" aria-hidden="true"
     aria-labelledby="getCroppedCanvasTitle" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="getCroppedCanvasTitle">Cropped</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close
                </button>
                <a class="btn btn-primary" id="download" href="javascript:void(0);"
                   download="cropped.jpg">Download</a>
            </div>
        </div>
    </div>
</div><!-- /.modal -->

<style>
    .docs-buttons > .btn, .docs-buttons > .btn-group, .docs-buttons > .form-control {
        margin-bottom: 1rem;
        margin-right: .50rem;
    }
</style>

<script src="{{ assetVersioned('js/admin/jquery-croppper-init.js') }}"></script>
<script src="{{ assetVersioned('js/lib/cropperjs/cropper.min.js') }}"></script>
<script src="{{ assetVersioned('js/lib/cropperjs/jquery-cropper.js') }}"></script>
<link rel="stylesheet" href="{{ assetVersioned('css/cropperjs/cropper.min.css') }}">