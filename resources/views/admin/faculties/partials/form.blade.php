@include('admin.partials.crud.elements.name')

<div class="row">
    <div class="col-md-8">
            @include('admin.partials.crud.elements.url')
    </div>
    @if(isSuperAdmin())
        <div class="col-md-4">
            {{--            @include('admin.partials.crud.checkbox', ['name' => 'manual', 'title' => 'Manual url'])--}}
        </div>
    @endif
</div>

    @include('admin.partials.crud.elements.image-upload-group')

<div class="row">
    <div class="col-3">
        @include('admin.partials.crud.elements.active')
    </div>
</div>

@include('admin.partials.crud.textarea.description')

@include('admin.partials.crud.js.init-description')

{{--@include('admin.partials.crud.textarea.excerpt')--}}
