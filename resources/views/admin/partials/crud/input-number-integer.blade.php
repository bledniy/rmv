@php
    $props = sprintf(' min="0" step="%s"', $step ?? 1);
    $type = 'number';
@endphp
@include('admin.partials.crud.default')