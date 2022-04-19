@include('admin.partials.crud.elements.name')

<div class="row">
    <div class="col-md-4">
        @include('admin.partials.crud.elements.active')
    </div>
    <div class="col-md-4">
        @include('admin.partials.crud.date.date-pub', ['value' => $edit->published_at ?? now()])
    </div>
</div>

{{--@include('admin.partials.crud.elements.url')--}}

{{--@include('admin.partials.crud.default', ['name' => 'video', 'title' => 'Ссылка на видео',])--}}

<div class="w-75">@include('admin.partials.crud.elements.image-upload-group')</div>

@include('admin.partials.crud.textarea.description')

@include('admin.partials.crud.textarea.excerpt', ['title' => 'Краткое описание (в списке новостей)'])
