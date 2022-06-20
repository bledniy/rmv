@include('admin.partials.crud.default',
[
    'title' => $title ?? __('form.date.time'),
    'type'  => $type ?? 'text',
    'name'  => $name ?? 'time',
    'props' => $props ?? 'data-flatpickr-type="time"',
    'default' => $default ?? now()->toTimeString()
])
