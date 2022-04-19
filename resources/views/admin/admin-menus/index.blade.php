<?php /** @var $list \App\Models\Admin\AdminMenu[]|\Illuminate\Support\Collection */ ?>
<div class="panel panel-default">
    <div class="panel-body clearfix">
        <a href="{{route($routeKey.'.create')}}" class="btn btn-default">Добавить +</a>
        <button class="btn btn-primary" type="submit" form="updateAll">Сохранить</button>
        @if (isSuperAdmin())
            <form action="" class="d-inline-block ml-5">
                <input type="hidden" name="seed" value="true">
                <div class="form-group d-inline-block">
                    <label for="truncate">Truncate</label>
                    <input id="truncate" type="checkbox" name="truncate" value="1">
                </div>
                <button class="btn btn-warning" href="?seed=true">Seed</button>
            </form>
        @endif
    </div>
</div>
<form id="updateAll" action="{{route('admin-menus.updateAll')}}" method="post">
    <input type="hidden" name="_method" value="PATCH">
    @csrf
    <div class="table-responsive">
        <div class="row">
            <div class="col-10 offset-2">
                <div class="d-flex justify-content-around">
                    <p>ID</p>
                    <p>@lang('form.title')</p>
                    <p>Значок шрифт</p>
                    <p>Включен</p>
                    <p>URL</p>
                    <p>Gate</p>
                </div>
            </div>
        </div>
        @if($list->isNotEmpty())
            <div class="dd">
                @include('admin.admin-menus.admin_menu_loop', ['menus' => $list])
            </div>
        @endif
    </div>
</form>

@push('js')
    <script>
        $(document).ready(function () {
            const nestableUrl = '{{ route('admin.admin-menus.nesting') }}';
            $('.dd').nestable({
                callback: function (l, e) {
                    $serialized = $('.dd').nestable('serialize');
                    updateNesting($serialized);
                }
            });

            function updateNesting(data) {
                const $data = {
                    'menus': data,
                };
                $.post(nestableUrl, $data,
                    function (data) {
                        if (data.message) {
                            let $status = (data.status) ? 'success' : 'error';
                            message(data.message, $status);
                        }
                    })
            }
        });
    </script>
@endpush