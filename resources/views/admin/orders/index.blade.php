<?php
use App\Models\Order\Order;
 ?>
<?php /** @var $item \App\Models\Order\Order */ ?>
@php
    /** @var $permissionKey string */
        $canEdit = false;
        $canDelete = Gate::allows('delete_'. $permissionKey );
        $canView = Gate::allows('view_'. $permissionKey );
@endphp
<div class="table-responsive">
    <table class="table table-shopping">
        <thead>
        <tr>
            <th class="">Номер заказа</th>
            <th class="th-description">Имя клиента</th>
            <th class="th-description">Номер телефона</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $item)
            <tr>
                <td>
                    <div class="col-2">
                        {{$item->getPrimaryKey()}}
                    </div>
                </td>
                <td>
                    <div class="col-6">
                        {{$item->getName()}}
                    </div>
                </td>
                <td>
                    <div class="col-10">
                        {{$item->getPhone()}}
                    </div>
                </td>
{{--                <td>--}}
{{--                    @include('admi0n.partials.preview-button', ['link' => route($key . '.show', $item->url),])--}}
{{--                </td>--}}
                <td class="text-primary text-right">
                    @include('admin.partials.action.index_actions')
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{{$orders->render()}}