@php
    $props = sprintf('step="%s"', $step ?? '0.01');
    $type = 'number';
@endphp
@include('admin.partials.crud.default')