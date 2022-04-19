<ul class="nav nav-tabs mb-5" role="tablist">
    <li role="presentation">
        <a href="#sliders-photosList" aria-controls="profile" role="tab"
           data-toggle="tab" class="active">Слайды ({{ $edit->items->count() }})</a>
    </li>
    @if(isSuperAdmin())
        <li role="presentation">
            <a class="" href="#sliders-dataDefault" aria-controls="home" role="tab"
               data-toggle="tab"></a>
        </li>
    @endif
</ul>
<section class="tab-content">

    <div role="tabpanel" class="tab-pane active" id="sliders-photosList">
        <div class="panel-body">
            @include('admin.sliders.partials.slides', ['slides' => $edit->items ])
        </div>
    </div>
    <div role="tabpanel" class="tab-pane " id="sliders-dataDefault">
        <div class="panel-body">
            @include('admin.sliders.partials.form')
        </div>
    </div>
</section>