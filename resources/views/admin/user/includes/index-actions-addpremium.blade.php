@php
    $cssClass = $cssClass ?? 'dropdown-item';
@endphp
<form action="{{ route('addprem', $user->id) }}" method="post" class="formActionConfirm"
      data-modal-text="Дать премиум пользователю">
    @csrf
    <button type="submit" class="{{ $cssClass }}">@lang('Добавить премиум')</button>
</form>
