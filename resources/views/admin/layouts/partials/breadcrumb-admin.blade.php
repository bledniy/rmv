<ol class="breadcrumb">
    @if(isset($breadcrumbs) AND is_array($breadcrumbs))
        @foreach($breadcrumbs as $num => $crumb)
            <li class="mr-2">
                <a href="{{ $crumb['url'] ?? '' }}"
                   class="align-middle text-decorated-hover mr-1">{{ $crumb['name'] ?? '' }}</a>
                @if(!$loop->last)<i class="align-middle fa fa-angle-right" aria-hidden="true"></i>@endif
            </li>
        @endforeach
    @endif
</ol>