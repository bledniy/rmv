@include('admin.partials.crud.elements.name', ['title' => 'Имя'])

<div class="row">
    @if(isSuperAdmin())
        <div class="col-md-4">
            {{--            @include('admin.partials.crud.checkbox', ['name' => 'manual', 'title' => 'Manual url'])--}}
        </div>
    @endif
</div>

    @include('admin.partials.crud.elements.image-upload-group')

<div class="row">
    <div class="col-3">
        @include('admin.partials.crud.elements.active')
    </div>
</div>

@include('admin.partials.crud.textarea.description')

@include('admin.partials.crud.js.init-description')

{{--@include('admin.partials.crud.textarea.excerpt')--}}


@include('admin.partials.crud.elements.email')

@include('admin.partials.crud.elements.phone')

@include('admin.partials.crud.select.select', ['list' => $departments,'name' => 'department_id', 'column' => 'name', 'title' => 'Department'])

@include('admin.partials.crud.select.select', ['list' => $faculties,'name' => 'faculty_id', 'column' => 'name', 'title' => 'Faculty'])


