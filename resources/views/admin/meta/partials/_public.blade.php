@include('admin.partials.crud.elements.active')


@include('admin.partials.crud.default', ['name' => 'title' ,'title' => 'Meta title'])

@include('admin.partials.crud.default', ['name' => 'keywords' ,'title' => 'Meta keywords'])

@include('admin.partials.crud.default', ['name' => 'description' ,'title' => 'Meta description'])
@if(0)

    @include('admin.partials.crud.default', ['name' => 'h1', 'title' => 'h1'])

    @include('admin.partials.crud.textarea', ['name' => 'header', 'title' => __('modules.seo.text-header')])

    @include('admin.partials.crud.textarea', ['name' => 'footer', 'title' => __('modules.seo.text-footer')])

    @include('admin.partials.crud.textarea', ['name' => 'text_top', 'title' => __('modules.seo.text-top')])

    @include('admin.partials.crud.textarea', ['name' => 'text_bottom', 'title' => __('modules.seo.text-bottom')])
@endif
