@include('admin.partials.flash-message')
<form action="{{route($routeKey. '.store')}}" method="post">
    @csrf
    <div class="table-responisve">
        <table class="table table-hover table-condensed table-striped">
            <tr class="active">
                <th>Ключ</th>
                <th>{{ __('modules.localization.value') }}</th>
{{--                <th>Подсказка</th>--}}
                <th>{{ __('modules.localization.type') }}</th>
                <th>{{ __('modules.localization.group') }}</th>
            </tr>
            <tr>
                <td>
                    <input type="text" name="key" value="{{ old('key') }}" class="form-control">
                </td>
                <td>
                    <input type="text" name="value" value="{{ old('value') }}"
                           class="form-control">
                </td>
                <td>
                    <input type="text" name="comment" value="{{ old('comment') }}"
                           class="form-control">
                </td>
                <td>
                    <select name="type" id="" autocomplete="off" class="form-control">
                        <option value="text">text</option>
                        <option value="textarea">textarea</option>
                        <option value="editor">Editor</option>
                    </select>
                </td>
                <td>
                    <select name="group" class="form-control group_select">
                        @forelse ($groups as $num => $group)
                            <option value="{{ $group }}">{{ $group }}</option>
                        @empty
                            <option value="">нет</option>
                        @endforelse
                    </select>
                </td>
            </tr>
        </table>
        <button class="btn btn-primary">{{ __('form.save') }}</button>
    </div>
</form>
@section('javascript')
    <script>
        $(".group_select").not('.group_select_new').select2({
            tags: true,
            width: 'resolve'
        });
    </script>
@stop
