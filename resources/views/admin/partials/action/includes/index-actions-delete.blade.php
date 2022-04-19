@php
	$cssClass = $cssClass ?? 'dropdown-item';
@endphp
<form action="{{ route($routeKey.'.destroy', $item->id) }}" method="post" class="formDeleteConfirm">
    @method('delete')
    @csrf
    <button type="submit" class="{{ $cssClass }}">@lang('form.delete')</button>
</form>