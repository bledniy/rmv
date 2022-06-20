<form action="{{ route($routeKey . '.store') }}" method="post">
    @csrf

    <div class="row">
        <div class="col-6">
            <button class="btn btn-warning btn-wide">
                <i class="fa fa-file-text-o" aria-hidden="true"></i>
                Generate sitemap</button>
        </div>
        <div class="col-6">
            @if($sitemapLink ?? false)
                <a class="btn btn-success" href="{{ $sitemapLink ?? '' }}" target="_blank">Sitemap <i class="fa fa-external-link"></i></a>
            @endif

        </div>
    </div>

</form>