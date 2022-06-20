<ul class="breadcrumb">
    @if(isset($breadcrumbs) AND is_array($breadcrumbs))
        @foreach($breadcrumbs as $num => $crumb)

            <li class="breadcrumbs__item">
                <a href="{{ $crumb['url'] ?? '' }}"
                   class="breadcrumbs__link" itemprop="item">{{ $crumb['name'] ?? '' }}
                </a>
            </li>

            @if(!$loop->last)<i class="align-middle fa fa-angle-right" aria-hidden="true"></i>@endif
        @endforeach
    @endif
</ul>