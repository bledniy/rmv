<form action="{{ route($routeKey . '.update', $edit->id) }}" method="post" class="form-horizontal"
      enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('admin.partials.submit_update_buttons')

    @include('admin.sliders.partials.edit-form')

    @include('admin.partials.submit_update_buttons')
</form>
