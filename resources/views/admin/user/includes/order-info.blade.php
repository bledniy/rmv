<div class="deal">
    <table class="table table-sm table-order-details m-0">
        <tbody>
        <tr>
            <td>Статус:</td>
            <td>{{ $order->getContainer()->getStatusName() }}</td>
            <td>Кол-во ставок:</td>
            <td>{{ $order->getContainer()->getBidsCount() }}</td>
        </tr>
        <tr>
            <td><b>Исполнитель</b></td>
            <td>
                @if ($order->getContainer()->hasPerformer())
                    <a href="{{ urlEntityEdit($order->getContainer()->getPerformer()) }}" class="text-secondary"
                    >✅ {{ $order->getContainer()->getPerformer()->getFio() }}</a>
                @else
                    Исполнитель не выбран
                @endif
            </td>
            <td>Кол-во просмотров:</td>
            <td>{{ $order->getContainer()->getViewsCount() }}</td>
        </tr>
        </tbody>
    </table>
</div>