@php
    $title =  $title ?? __('modules._.preview');
@endphp
<a class="btn btn-primary" target="_blank" href="{{ $link }}">{{ $title }}
    <i class="fa fa-external-link"></i></a>