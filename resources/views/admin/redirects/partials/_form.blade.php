<div class="row">
    <div class="col-md-9">
        @include('admin.redirects.elements.from')
    </div>
    <div class="col-md-3">
        @isset($edit)
            @include('admin.partials.preview-button', ['link' => $edit->from])
        @endisset
    </div>
</div>

@include('admin.redirects.elements.to')

<div class="row">
    <div class="col-md-6">
        @include('admin.redirects.elements.code')
    </div>
    <div class="col-md-6">
        @include('admin.partials.crud.elements.active')
    </div>
</div>
