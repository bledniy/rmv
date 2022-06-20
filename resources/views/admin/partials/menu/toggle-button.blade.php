@if ($hasChild)
    <div class="btn collapse-btn"
          data-toggle="collapse" data-target="#collapse-{{ $item->id }}" aria-expanded="true"
          aria-controls="collapse-{{ $item->id }}">
                            <i class="fa fa-angle-up rotateable" aria-hidden="true"></i>
    </div>
@endif