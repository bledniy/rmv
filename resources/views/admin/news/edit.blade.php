<?php /** @var $edit \App\Models\News\News */ ?>
<form action="{{ route($routeKey.'.update', $edit->id) }}" method="post" class="form-horizontal"
      enctype="multipart/form-data">
    @csrf
    @method('patch')

    @include('admin.partials.submit_update_buttons')
    <ul class="nav nav-tabs mb-5" role="tablist">
        <li role="presentation">
            <a class="active" href="#dataDefault" aria-controls="home" role="tab"
               data-toggle="tab">@lang('modules._.tabs.main')</a>
        </li>
    </ul>
    <section class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="dataDefault">
            <div class="panel-body">
                @include('admin.news.partials.form')
            </div>
        </div>
    </section>
    @include('admin.partials.submit_update_buttons')
</form>

{{--<div class="row mt-5">--}}
{{--    <div class="col-md-6 text-left">--}}
{{--        @if ($prevNews = $edit->prevNew)--}}
{{--            <i class="fa fa-angle-left" aria-hidden="true"></i>--}}
{{--            <a href="{{ route(routeKey('news', 'edit'), $prevNews->id) }}" title="Предыдущая новость">{{ $prevNews->name }}</a>--}}
{{--        @endif--}}
{{--    </div>--}}
{{--    <div class="col-md-6 text-right">--}}
{{--        @if ($nextNews = $edit->nextNew)--}}
{{--            <a href="{{ route(routeKey('news', 'edit'), $nextNews->id) }}" title="Следующая новость">{{ $nextNews->name }}</a>--}}
{{--            <i class="fa fa-angle-right" aria-hidden="true"></i>--}}
{{--        @endif--}}
{{--    </div>--}}
{{--</div>--}}

{{--@include('admin.partials.crud.js.init-description')--}}
