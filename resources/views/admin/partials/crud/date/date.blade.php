@include('admin.partials.crud.default',
[
    'title' => $title ?? __('form.date.date'),
    'type'  => $type ?? 'text',
    'name'  => $name ?? 'date',
    'props' => $props ?? 'data-flatpickr-type="date"',
    'default' => $default ?? now()->toDateString()
])
