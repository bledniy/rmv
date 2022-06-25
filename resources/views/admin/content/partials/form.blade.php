<?php /** @var $contentFieldsList \App\Contents\AbstractContentFieldsList */ ?>
<?php /** @var $edit \App\Models\Content\Content*/ ?>

<div class="row">
    @if(isset($edit))
        <input type="hidden" name="content_id" value="{{ $edit->getKey() }}">
    @endif
    <div class="col-12">
        @if ($contentFieldsList->hasName())
            @includeIf('admin.partials.crud.elements.name', ['title' => $contentFieldsList->getTitleName()])
        @endif
    </div>
    <div class="col-12">
        @if ($contentFieldsList->hasTitle())
            @includeIf('admin.partials.crud.elements.title', ['title' => $contentFieldsList->getTitleTitle()])
        @endif
    </div>
    <div class="col-6 offset-1">
        @if ($contentFieldsList->hasImage())
            @includeIf('admin.partials.crud.elements.image-upload-group', ['title' => $contentFieldsList->getTitleImage()])
        @endif
    </div>
    <div class="col-6 offset-1">
        @if ($contentFieldsList->hasAdditionalImage())
            @includeIf('admin.partials.crud.elements.image-upload-group',
                ['name' => \App\Contents\ContentFieldsTypeInterface::ADDITIONAL_IMAGE, 'title' => $contentFieldsList->getTitleImage()])
        @endif
    </div>
    <div class="col-6">
        @if ($contentFieldsList->hasActive())
            @include('admin.partials.crud.elements.active', ['title' => $contentFieldsList->getTitleActive()])
        @endif
    </div>
    <div class="col-12">
        @if ($contentFieldsList->hasUrl())
            @include('admin.partials.crud.elements.url', ['title' => $contentFieldsList->getTitleUrl()])
        @endif
    </div>
</div>
<div class="row">
    <div class="col-12">
        @if ($contentFieldsList->hasDescription())
            @include('admin.partials.crud.textarea.description', ['title' => $contentFieldsList->getTitleDescription()])
        @endif
    </div>
    <div class="col-12">
        @if ($contentFieldsList->hasExcerpt())
            @include('admin.partials.crud.textarea.excerpt', ['title' => $contentFieldsList->getTitleExcerpt()])
        @endif
    </div>
</div>
@include('admin.partials.crud.js.init-description')


