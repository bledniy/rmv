<div class="cursor-pointer" data-id="{{ $item->getKey() }}" data-table="{{ $item->getTable() }}"
     @if (isset($deleteCallback))
     onclick="deleteItem(this, {{ $deleteCallback }})"
     @else
     onclick="deleteItem(this)"
    @endif
>
    <i class="fa fa-times fa-1x" aria-hidden="true"></i>
</div>
