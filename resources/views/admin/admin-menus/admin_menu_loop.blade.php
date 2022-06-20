<?php /** @var $menu \App\Models\Admin\AdminMenu */ ?>

<ol class="dd-list ml-3">
    @foreach($menus as $menu)
        @php
            $id = $menu->getKey();
            $inputManager = inputNamesManager($menu);
        @endphp
        <li class="dd-item " data-id="{{ $menu->id }}">
            <div class="row mx-0 bordered border-none b-bottom color-light">
                <div class="col-2 px-0">
                    <div class=" d-inline-block dd-handle cursor-move ">
                        <div class="d-inline-block">
                            @include('admin.partials.sort_handle_small')
                        </div>
                        {{ $menu->getName() }}
                    </div>
                </div>
                <div class="col-10 d-flex justify-content-between">
                    <div class="">
                        <a href="{{ route($routeKey . '.edit', $id) }}">{{$id}}</a>
                        <input type="hidden" name="{{ $inputManager->getNameInputByKey('id') }}" value="{{$id}}">
                    </div>
                    <div class="">
                        <input type="text" name="{{ $inputManager->getNameInputByKey('name') }}" value="{{$menu->name}}"
                               class="form-control">
                    </div>
                    <div class="">
                        <input type="text" class="form-control"
                               name="{{ $inputManager->getNameInputByKey('icon_font') }}"
                               value="{{$menu->icon_font}}">
                    </div>
                    <div class="">
                        <div class="check-styled">
                            <input type="checkbox" value="1" id="active-{{$id}}"
                                   name="{{ $inputManager->getNameInputByKey('active') }}"
                                   {!! checkedIfTrue((int)$menu->active) !!}
                                   data-send-no-disable="true"/>
                            <label for="active-{{$id}}"></label>
                        </div>
                    </div>
                    <div class="">
                        <input type="text" name="{{ $inputManager->getNameInputByKey('url') }}" value="{{$menu->url}}"
                               class="form-control">
                    </div>
                    <div class="">
                        <input type="text" name="{{ $inputManager->getNameInputByKey('gate_rule') }}"
                               value="{{$menu->gate_rule}}"
                               class="form-control">
                    </div>
                </div>
            </div>
            @if($menu->childrens->isNotEmpty())
                @include('admin.admin-menus.admin_menu_loop', ['menus' => $menu->childrens])
            @endif
        </li>
    @endforeach
</ol>
