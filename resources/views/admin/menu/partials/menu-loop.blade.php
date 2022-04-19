<?php /** @var $menu \App\Models\Menu */ ?>
<ol class="dd-list" {{--style="display: none;"--}}>
    @foreach($menus as $menu)
        <li class="dd-item " data-id="{{ $menu->id }}">
            <div class="row mx-0 bordered border-none b-bottom color-light">
                <div class="col-2 px-0">
                    <div class="dd-handle cursor-move ">{{ $menu->getMenuName() }}</div>
                </div>
                <div class="col-10">
{{--                    <img src="{{ getPathToImage($menu->getImage()) }}" class="img-fluid" width="40" alt="">--}}
                    <div class="text-right">
                        <div class="dropdown menu_drop">
                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                    id="dropdownMenuButton_{{ $menu->id }}" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">menu</i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_{{ $menu->id }}">
                                @can('edit_' . $permissionKey)
                                    <a href="{{ route($routeKey . '.edit',  $menu->id)  }}" class="dropdown-item">@lang('form.edit')</a>
                                @endcan
                                @if($menu->canDelete())
                                    @can('delete_' . $permissionKey)
                                        {!! Form::open( ['method' => 'delete', 'url' => route($routeKey . '.destroy', $menu->id), 'class' => 'formDeleteConfirm']) !!}
                                        <button type="submit" class="dropdown-item">@lang('form.delete')</button>
                                        {!! Form::close() !!}
                                    @endcan
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if($menu->allMenus->isNotEmpty())
                @include('admin.menu.partials.menu-loop', ['menus' => $menu->allMenus])
            @endif
        </li>
    @endforeach
</ol>
