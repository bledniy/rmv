<?php /** @var $edit \App\Models\Meta */ ?>
<form action="{{ route($routeKey . '.update', $edit->id)}}" method="post" class="form-horizontal"
      enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    @include('admin.partials.submit_update_buttons')

    @include('admin.redirects.partials._form')

    @include('admin.partials.submit_update_buttons')
</form>
