<?php /** @var $edit \App\Models\Meta */ ?>
<form action="{{ route($routeKey . '.update', $edit->id)}}" method="post" class="form-horizontal"
      enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div class="form-group mb-5">
        <div class="col">
            <div class="row">
                <div class=" col-8">
                    @include('admin.partials.submit_update_buttons')
                </div>
                <div class="col-sm-4">
                    <a class="btn btn-default" target="_blank"
                       href="{{ frontendUrl($edit->url) }}">@lang('modules._.preview')<i
                                class="fa fa-external-link"></i></a>
                </div>
            </div>
        </div>
    </div>
    @if ($edit->isDefault())
        <h4 class="badge badge-warning d-inline-block">@lang('modules.meta.default')</h4>
    @endif

    @if(isSuperAdmin())
        @include('admin.partials.crud.elements.url', ['props' => 'readonly=""'])
    @endif

    @include('admin.partials.crud.elements.active')

    @if($edit->isNotDefault())
        @include('admin.partials.crud.default', ['name' => 'h1', 'title' => 'h1'])
    @endif

    @include('admin.partials.crud.default', ['name' => 'title' ,'title' => 'Meta title'])

    @include('admin.partials.crud.default', ['name' => 'keywords' ,'title' => 'Meta keywords'])

    @include('admin.partials.crud.default', ['name' => 'description' ,'title' => 'Meta description'])

    @if($edit->isNotDefault())

        @include('admin.partials.crud.textarea', ['name' => 'header', 'title' => __('modules.seo.meta-header')])

        @include('admin.partials.crud.textarea', ['name' => 'footer', 'title' => __('modules.seo.meta-footer')])

        @include('admin.partials.crud.textarea', ['name' => 'text_top', 'title' => __('modules.seo.text-top')])

        @include('admin.partials.crud.textarea', ['name' => 'text_bottom', 'title' => __('modules.seo.text-bottom')])
    @endif

    @include('admin.partials.submit_update_buttons')
</form>
@section('javascript')
    <script defer>
        $(document).ready(function () {
            {!! showEditor('text_top') !!}
            {!! showEditor('text_bottom') !!}
        });
    </script>
@stop
