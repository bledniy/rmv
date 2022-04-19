<?php /** @var $ordersAsPerformer \Illuminate\Support\Collection | \App\Models\Order\Order[] */ ?>
<?php /** @var $ordersAsCustomer \Illuminate\Support\Collection | \App\Models\Order\Order[] */ ?>
<div class="card">
    <div class="card-header">
        <a class="btn btn-primary" data-toggle="collapse" href="#collapse_orders_as_customer" role="button" aria-expanded="false"
           aria-controls="collapseExample" title="нажмите чтобы свернуть / развернуть список">
            Сделки в роли <b>заказчика</b> {{ $ordersAsCustomer->count() }}
        </a>
    </div>
    <div class="collapse show" id="collapse_orders_as_customer">
        <div class="card-body">
            @foreach($ordersAsCustomer as $order)
                <div class="card">
                    <div class="card-header">
                        <a href="{{ urlEntityEdit($order) }}">{{ $order->getContainer()->getTitle() }}</a></div>
                    <div class="card-body d-flex">
                        <div class="customer">
                            <span class="customer-avatar mb-3 d-inline-block" style="background-image: url({{ $order->getContainer()->getCustomer()->getAvatarHelper()->getCustomerAvatar() }});"></span>
                            <a href="{{ urlEntityEdit($order->getContainer()->getCustomer()) }}" class="align-top fio">{{ $order->getContainer()->getCustomer()->getFio() }}</a>
                        </div>
                       @includeIf('admin.user.includes.order-info')
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <a class="btn btn-primary" data-toggle="collapse" href="#collapse_orders_as_performer" role="button" aria-expanded="false"
           aria-controls="collapseExample" title="нажмите чтобы свернуть / развернуть список">
            Сделки в роли <b>исполнителя</b> {{ $ordersAsPerformer->count() }}
        </a>
    </div>
    <div class="collapse show" id="collapse_orders_as_performer">
        <div class="card-body">
            @foreach($ordersAsPerformer as $order)
                <div class="card">
                    <div class="card-header">
                        <a href="{{ urlEntityEdit($order) }}">{{ $order->getContainer()->getTitle() }}</a>
                    </div>
                    <div class="card-body d-flex">
                        @includeIf('admin.user.includes.order-info')
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

