@include('admin.partials.crud.default',
[
    'title' => __('form.date.date-pub'),
    'type'  => 'datetime-local',
    'name'  => 'published_at',
    'props' => 'data-flatpickr-type="datetime_local"'
])
