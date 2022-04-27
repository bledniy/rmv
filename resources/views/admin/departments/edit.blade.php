<?php /** @var $edit \App\Models\Faculty\Faculty */ ?>

<form action="{{ route($routeKey . '.update', $edit->id) }}" method="post" class="form-horizontal"
      enctype="multipart/form-data">
    @csrf
    @method('patch')


    <div class="row">
        <div class="col-md-6">
{{--            @include('admin.partials.preview-button', ['link' => $edit->getRouteUrl()])--}}
        </div>
        <div class="col-md-6">
            @include('admin.partials.submit_update_buttons')
        </div>
    </div>

    @include('admin.departments.partials.form')

    @include('admin.partials.submit_update_buttons')
</form>
@include('admin.partials.crud.js.init-description-except')
