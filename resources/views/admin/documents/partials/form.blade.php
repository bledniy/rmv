@include('admin.partials.crud.elements.name')

<div class="row">
    @if(isSuperAdmin())
        <div class="col-md-4">
            {{--            @include('admin.partials.crud.checkbox', ['name' => 'manual', 'title' => 'Manual url'])--}}
        </div>
    @endif
</div>
<div class="col-3">
    @include('admin.partials.crud.elements.file')
</div>
@include('admin.partials.crud.elements.file-upload')


{{--<div class="col-md-6">--}}

{{--    <button type="submit" class="btn btn-success">Upload</button>--}}

{{--</div>--}}
<div class="row">
    <div class="col-3">
        @include('admin.partials.crud.elements.active')
    </div>
</div>

@include('admin.partials.crud.textarea.description')


{{--@include('admin.partials.crud.textarea.excerpt')--}}
