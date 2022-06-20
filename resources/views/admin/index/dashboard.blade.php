<?php /** @see \App\Http\Controllers\Admin\IndexController */ ?>

<?php /** @var $chart \LaravelDaily\LaravelCharts\Classes\LaravelChart */ ?>
<?php /** @var $charts \Illuminate\Support\Collection */ ?>
<?php /** @var $widgets \Illuminate\Support\Collection */ ?>
<?php /** @var $widget \App\Widgets\AbstractWidget */ ?>

{!! $html ?? '' !!}
@php
    $types = ['warning','error','success','info',];
@endphp
@foreach($types as $type)
    @if (session($type))
        <div class="alert alert-{{ $type }} alert-dismissible fade show">
            {!! session($type) !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fa fa-times"></i></span>
            </button>
        </div>
    @endif
@endforeach
<div class="row">
    <div class="col-md-3">
        <form action="{{ route('cache.clear') }}" method="post">
            @csrf
            <button class="btn btn-primary" title="Clear cache menus and etc...">Clear application cache</button>
        </form>
    </div>
    <div class="col-md-3">
        <form action="{{ route('cache.view') }}" method="post">
            @csrf
            <button class="btn btn-danger">Clear views cache</button>
        </form>
    </div>
    @if (isSuperAdmin())
        <div class="col-md-3">
            <form action="{{ route('artisan.storage.link') }}" method="post">
                @csrf
                <button class="btn btn-default">Storage:link</button>
            </form>
        </div>
        <div class="col-md-2">
            <a href="{{ env('FRONT_APP_URL') }}" class="btn btn-info" target="_blank">Перейти на сайт</a>
        </div>
    @endif
</div>


@if (isset($widgets) && $widgets->isNotEmpty())
    @foreach($widgets as $widget)
        {!! $widget->renderWidget() !!}
    @endforeach
@endif

@if ($charts->isNotEmpty())
    {!! $charts->first()->renderChartJsLibrary() !!}
    @foreach($charts as $chart)
        <div class="mt-4">
            {!! $chart->renderHtml() !!}
        </div>
        {!! $chart->renderJs() !!}
    @endforeach
@endif