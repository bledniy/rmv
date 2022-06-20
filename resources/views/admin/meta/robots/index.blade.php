<form method="post" action="{{route($routeKey.'.update')}}">
    @csrf
    @method('put')

    <div class="row">
        <div class="col-md-12">
            @include('admin.partials.crud.textarea',['title'=>'Редактирование robots.txt','name'=>'robots','value'=>$data])
        </div>
    </div>
    @include('admin.partials.submit_update_buttons')
</form>
