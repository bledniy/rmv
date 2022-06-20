<?php /** @var $translate \App\Models\Translate\Translate */ ?>
<div class="panel panel-default">
    <div class="panel-body clearfix">
        <div class="row">
            <div class="col-4">
                @can('edit_translate')
                    <button class="btn btn-primary" type="submit" form="translate_form">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                        {{ __('form.save') }}</button>
                @endcan
                @if(isSuperAdmin())
                    <a class="btn btn-warning" href="{{ route($routeKey.'.index') }}?seed=true">Seed</a>
                @endif
            </div>
            <div class="col-8">
                <form action="" method="get">
                    <div class="form-group">
                        <div class="row">
                            @if (isSuperAdmin())
                                <div class="col-2">
                                    @include('admin.partials.crud.checkbox', ['name' => 'with_trashed', 'title' => 'With deleted', 'checked' => $request->has('with_trashed') ])
                                </div>
                            @endif
                            <div class="col-7">
                                @include('admin.partials.crud.default', ['name' => 'search', 'title' => 'Search', 'value' => $request->get('search'),])
                            </div>
                            <div class="col-3">
                                <button class="btn btn-danger" type="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                    @lang('form.search')
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<form action="{{route($routeKey. '.update', '*')}}" method="post" data-send-only-changed="true" id="translate_form">
    <input type="hidden" name="_method" value="PATCH">
    <input type="hidden" name="setting_tab" class="setting_tab" value="{{ $active }}">
    @csrf
    <ul class="nav nav-tabs my-5" id="translates" role="tablist">
        @foreach($groups as $group)
            @php
                $isActive = ($active === $group);
            @endphp
            <li class="nav-item">
                <a class="nav-link text-dark @if($isActive) active @endif" id="{{ $group }}-tab" data-toggle="tab"
                   href="#group-{{ $group }}" role="tab"
                   aria-controls="group-{{ $group }}" aria-selected="@if($isActive) true @endif">{{ $group }}</a>
            </li>
        @endforeach
    </ul>
    <div class="tab-content" id="translatesContent">
        @foreach($groups as $group)
            @php
                $isActive = (($active ?? null) === ($group ?? null));
            @endphp
            <div class="tab-pane @if($isActive) active @endif" id="group-{{ $group }}" role="tabpanel">
                <div class="table-responisve">
                    <table class="table table-hover table-condensed table-striped">
                        <tr class="active">
                            <th>ID</th>
                            <th>{{ __('modules.localization.key') }}</th>
                            <th>{{ __('modules.localization.value') }}</th>
                            @if(isSuperAdmin())
                                <th>{{ __('modules.localization.group') }}</th>
                            @endif
                        </tr>
                        @if(isset($list))
                            @forelse($list->where('group', $group) as $translate)
                                <tr data-id="{{ $translate->getKey() }}" data-deleteable-row="">
                                    <td width="20">
                                        {{$translate->getKey()}}
                                        <input type="hidden" name="translate[{{$translate->getKey()}}][id]"
                                               value="{{$translate->getKey()}}">
                                    </td>
                                    <td width="200">
                                        <input type="hidden" name="translate[{{ $translate->getKey() }}][key]"
                                               value="{{$translate->key}}">
                                        <input type="text" value="{{$translate->key}}" class="form-control" readonly=""
                                               title="{{ $translate->comment }}"
                                               onclick="copyClickBoard(this)" autocomplete="off"
                                               data-prepend="{{ $translate->getPrependClickBoardText() }}"
                                               data-append="{{ $translate->getAppendClickBoardText() }}">
                                    </td>
                                    <td title="{{ $translate->comment }}">
                                        @include('admin.translate.includes.types.text')
                                        @include('admin.translate.includes.types.textarea')
                                        @include('admin.translate.includes.types.editor')
                                    </td>
                                    <td width="200">
                                        @if(isSuperAdmin())
                                            <div class="d-inline-block">
                                                <select name="translate[{{$translate->getKey()}}][group]"
                                                        class="form-control group_select">
                                                    @forelse ($groups as $group)
                                                        <option value="{{ $group }}"
                                                                @if($group == $translate->group) selected="selected" @endif>{{
														$group }}
                                                        </option>
                                                    @empty
                                                        <option value="">No</option>
                                                    @endforelse
                                                </select>
                                            </div>
                                            <div class="d-inline-block">
                                                @include('admin.partials.delete_ajax_button', ['item' => $translate])
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <h3>Пусто</h3>
                            @endforelse
                        @endif
                    </table>
                </div>
            </div>
        @endforeach
    </div>
</form>

@push('js')
    <script src="{{ asset('js/lib/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/lib/select2/ru.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(".group_select").not('.group_select_new').select2({
                tags: true,
                width: 'resolve'
            })

            $('[data-toggle="tab"]').click(function () {
                $(".setting_tab").val($(this).html());
            });

            const editors = $('.ckeditor-default')
            editors.each((i, e) => {
                editor = CKEDITOR.replace(e, {
                    uiColor: '#9AB8F3',
                    height: 300
                })

                editor.on('change', _.debounce(function (event) {
                    $(e).val(event.editor.getData()).change()
                }, 3000));
            })
            // console.log(CKEDITOR.instances)


        });
    </script>
@endpush

@push('css')
    <link rel="stylesheet" href="{{ asset('_admin/css/select2.min.css') }}">
@endpush