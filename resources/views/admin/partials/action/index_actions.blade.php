@php
    $routeKey = $routeKey ?? $key ?? '';
    $permissionKey = $permissionKey ?? $key ?? '';
    $canEdit = $canEdit ?? Gate::allows('edit_'. $permissionKey);
    $canDelete = $canDelete ?? Gate::allows('delete_'. $permissionKey);
    $canView = $canView ?? false;
@endphp
<div class="dropdown menu_drop">
    <button
            class="btn btn-secondary dropdown-toggle" type="button"
            id="dropdownMenuButton_{{ $item->id }}" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
        <i class="material-icons">menu</i>
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_{{ $item->id }}">
        @if($canView)
            @includeIf('admin.partials.action.includes.index-actions-show')
        @endif
        @if($canEdit)
            @includeIf('admin.partials.action.includes.index-actions-edit')
        @endif
        @if($canDelete)
            @includeIf('admin.partials.action.includes.index-actions-delete')
        @endif

        {!! $indexActions ?? '' !!}
    </div>
</div>