{!! session()->get('message', '') !!}
{!! $message ?? '' !!}
<form action="{{route($controller.'Action', 'watermark')}}" method="post">
    {{csrf_field()}}
    <div class="panel panel-default">
        <div class="panel-body clearfix">
            <button class="btn btn-primary">Сохранить</button>
        </div>
    </div>
    @foreach($editable as $table => $name)
        <div class="form-group">
            <label>
                <input type="checkbox" name="tables[{{$table}}]" value="1" autocomplete="off"
                        {{ (isset($config['tables'][$table]) AND $config['tables'][$table] == 1) ? 'checked' : '' }}>
                <span>{{$name}}</span>
            </label>
        </div>
    @endforeach
</form>
