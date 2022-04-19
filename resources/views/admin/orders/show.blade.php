<?php /** @var $cartCalcData \App\DataContainers\Cart\CartCalcData */ ?>
<?php /** @var $cartData \App\DataContainers\Cart\CartData */ ?>
<?php /** @var $order \App\Models\Order\Order */ ?>
@php
    $deliveryEnum = $order->getOrderDeliveryTypeEnum();
@endphp
<div class="table-responsive">
    <table class="table">
        <tr>
            <td>Имя</td>
            <td>{{ $order->getName() }}</td>
        </tr>
        <tr>
            <td>Способ Доставки</td>
            <td>{{ $deliveryEnum->getTitle() }}</td>
        </tr>
        <tr>
            @if($deliveryEnum->isDelivery())
                <td>Улица : {{ $order->getStreet() }}</td>
                <td>Номер дома : {{ $order->getBuilding() }}</td>
                <td>Подъезд : {{ $order->getPorch() }}</td>
                <td>Этаж : {{ $order->getFloor() }}</td>
                <td>Номер квартиры : {{ $order->getFlatNum() }}</td>
            @else
            @endif
        </tr>
        <tr>
            <td>Способ Оплаты</td>
            <td>{{ $order->getOrderPaymentTypeEnum()->getTitle() }}</td>
        </tr>
        <tr>
            <td>Телефон</td>
            <td>{{ $order->getPhone() }}</td>
        </tr>
        <tr>
            <td>Кол-во персон</td>
            <td>{{ $order->getPersons() }}</td>
        </tr>
        <tr>
            <td>Время доставки</td>
            <td>{{ $order->getDeliveryData() }}</td>
        </tr>
        <tr>
            <td>Комментарий к заказу</td>
            <td>{{ $order->getComment() }}</td>
        </tr>
    </table>
    <table class="table">
       <tr>
           <th>Название товара</th>
           <th>Цена за ед.</th>
           <th>Кол-во</th>
           <th>Общая цена</th>
       </tr>
        @foreach($order->getOrderProducts() as $orderProduct)
            <tr>
                <td>
                    <a href="{{ route('admin.products.edit', $orderProduct->getProductId()) }}">{{ $orderProduct->getName() }}</a>
                </td>
                <td>{{ $orderProduct->getPrice() }} {{ getCurrencyIcon() }}</td>
                <td>{{ $orderProduct->getQuantity() }} шт.</td>
                <td>{{ $orderProduct->getCost() }} {{ getCurrencyIcon() }}</td>
            </tr>
        @endforeach
        <tr>
            <td>ЦЕНА ЗАКАЗА</td>
            <td>{{ $order->amount }} {{ getCurrencyIcon() }}</td>
        </tr>
    </table>
</div>

