<form action="{{ route($routeKey . '.store') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
    @method('post')
    @csrf
    @include('admin.partials.submit_create_buttons')

    @include('admin.content.partials.form')

    @include('admin.partials.submit_create_buttons')
</form>
