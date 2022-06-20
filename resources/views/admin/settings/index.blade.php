<?php /** @var $request \Illuminate\Http\Request */ ?>
@include('admin.settings.partials.css')

@php
    $canAdd = $canEdit ?? Gate::allows('add_'. $permissionKey);
    $canEdit = $canEdit ?? Gate::allows('edit_'. $permissionKey);
    $canDelete = $canDelete ?? Gate::allows('delete_'. $permissionKey);
@endphp
<form action="{{ route('settings.index') }}">
    <div class="card">
        {{--		<div class="card-header">Params</div>--}}
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    @include('admin.partials.crud.default', ['name' => 'search', 'title' => 'Search', 'value' => $request->get('search'),])
                </div>
                @if (isSuperAdmin())
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('settings.index') }}" class="btn btn-danger">Reset</a>
                        <a class="btn btn-warning" href="{{ route('settings.index') }}?seed=true">Seed</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</form>
<?php /** @var $setting \App\Models\Setting */ ?>
<form action="{{ route('settings.update', '*') }}" method="POST" enctype="multipart/form-data">
    @if ($canEdit)
        <div class="text-right">
            <button type="submit" class="btn btn-primary "><i class="fa fa-floppy-o" aria-hidden="true"></i>
                {{ __('settings.save') }}</button>
        </div>
    @endif
    {{ method_field("PUT") }}
    <input type="hidden" name="setting_tab" class="setting_tab" value="{{ $active }}">
    @csrf
    <ul class="nav nav-tabs mb-5" id="settings" role="tablist">
        @foreach($groups as $group)
            @php
                $isStaff = ($group === '_');
                $displayName = $group;
                $classes = $isStaff ? 'text-danger': '';
                $isActive = ($active === $displayName);
                if($isActive) $classes .= ' active';
            @endphp
            <li class="nav-item">
                <a class="nav-link text-dark {{ $classes }}" id="{{ $group }}-tab" data-toggle="tab"
                   href="#group-{{ $group }}" role="tab"
                   aria-controls="group-{{ $group }}" aria-selected="@if($isActive) true @endif">{{ $displayName }}</a>
            </li>
        @endforeach
    </ul>
    <div class="tab-content" id="settingsContent">
        @foreach($groups as $num => $group)
            @php
                $isActive = ($active === $group);
                if($isActive) $classes .= ' active';
            @endphp
            <div class="tab-pane @if($isActive) active @endif" id="group-{{ $group }}" role="tabpanel"
            >
                @foreach($settings->where('group', $group) as $setting)
                    @php
                        $id = $setting->getKey();
                    @endphp
                    <div class="setting-item mb-4">
                        <div class="panel-heading mt-3">
                            <div class="row">
                                <div class="col col-md-8">
                                    <input type="hidden" name="settings[{{ $id }}][id]" value="{{ $id }}">
                                    @if(isSuperAdmin())
                                        <div class="row">
                                            <div class="col-6">
                                                <input type="text" class="form-control max-width-300"
                                                       onclick="copyClickBoard(this)"
                                                       readonly value="{{ $setting->key }}"
                                                       data-prepend="{{ $setting->getPrepend() }}"
                                                       data-append="{{ $setting->getAppend() }}">
                                            </div>
                                            <div class="col-6">
                                                @if ($setting->user)
                                                    <a href="{{ route(routeKey('users', 'edit'), $setting->user->id) }}"
                                                       title="edited by"
                                                    >{{ $setting->user->email }}</a>
                                                    <p>{{ $setting->updated_at->format('Y:m:d') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                    <h6 class="panel-title mt-0">{{ $setting->display_name }}</h6>
                                </div>
                                <div class="col col-md-4">
                                    <div class="row">
                                        <div class="col-10">
                                            <div class="px-0">
                                                @if(isSuperAdmin())
                                                    <select class="form-control group_select"
                                                            name="settings[{{ $id }}][group]">
                                                        @foreach($groups as $group)
                                                            <option
                                                                    value="{{ $group }}" {!! $setting->group == $group ? 'selected' : '' !!}>
                                                                {{ $group }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="panel-actions text-right">
                                                @if ($canDelete)
                                                    <i class="voyager-trash fa fa-times" aria-hidden="true"
                                                       data-id="{{ $setting->id }}"
                                                       data-display-key="{{ $setting->key }}"
                                                       data-display-name="{{ $setting->display_name }}"></i>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel-body px-0">
                            <div class="col">
                                @if ($setting->type == "text")
                                    <input type="text" class="form-control" autocomplete="off"
                                           name="@include('admin.settings.types.value-key')"
                                           value="{{ \Arr::get($setting, 'value') }}">
                                @elseif($setting->type == "text_area")
                                    @include('admin.settings.types.textarea')
                                @elseif($setting->type == "rich_text_box")
                                    <textarea class="form-control richTextBox"
                                              name="@include('admin.settings.types.value-key')">{{ \Arr::get($setting, 'value') }}</textarea>
                                @elseif($setting->type == "ckeditor")
                                    @include('admin.settings.types.ckeditor')
                                @elseif($setting->type == "code_editor")
                                    @include('admin.settings.types.code_editor')
                                @elseif($setting->isFile())
                                    @include('admin.settings.types.files')
                                @elseif($setting->type == "select_dropdown")
                                    @include('admin.settings.types.select_dropdown')
                                @elseif($setting->type == "radio_btn")
                                    @include('admin.settings.types.radio')
                                @elseif($setting->type == "checkbox")
                                    @include('admin.settings.types.checkbox')
                                @elseif($setting->type == "key_value")
                                    @include('admin.settings.types.key_value')
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
    @if ($canEdit)
        <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-floppy-o" aria-hidden="true"></i>
            {{ __('settings.save') }}</button>
    @endif
</form>
<div style="clear:both"></div>
@if ($canAdd)
    @include('admin.settings.partials.add')
@endif
@if ($canDelete)
    @include('admin.settings.partials.modal-delete')
@endif
{{--<form id="my_form" action="{{ route('upload') }}" target="form_target" method="POST"--}}
{{--enctype="multipart/form-data" style="width:0;height:0;overflow:hidden">--}}
{{--{{ csrf_field() }}--}}
{{--<input name="image" id="upload_file" type="file" onchange="$('#my_form').submit();this.value='';">--}}
{{--<input type="hidden" name="type_slug" id="type_slug" value="settings">--}}
{{--</form>--}}

@section('javascript')
    @include('admin.settings.partials.js')
@stop
