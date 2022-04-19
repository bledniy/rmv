<?php /** @var $perm \App\Models\Permission */ ?>
<div class="card my-3">
    <div class="card-header" role="tab" id="{{ isset($title) ? Str::slug($title) :  'permissionHeading' }}">
        <h4 class="mb-0">
            <a role="button" data-toggle="collapse"
               href="#dd-{{ isset($title) ? Str::slug($title) :  'permissionHeading' }}"
               aria-expanded="{{ isset($closed) ? 'true' : 'false' }}"
               aria-controls="dd-{{ isset($title) ? Str::slug($title) :  'permissionHeading' }}">
                {{ $title ?? __('modules.roles.additional-permissions') }} {!! isset($user) ? '<span class="text-danger">(' . $user->getDirectPermissions()->count() . ')</span>' : '' !!}
            </a>
        </h4>
    </div>
    <div id="dd-{{ isset($title) ? Str::slug($title) :  'permissionHeading' }}"
         class="card-collapse collapse {{ $closed ?? 'in' }}" role="tabcard"
         aria-labelledby="dd-{{ isset($title) ? Str::slug($title) :  'permissionHeading' }}">
        <div class="card-body">
            <div class="row">
                @foreach($permissions as $group => $permissionsItems)
                    <div class="col-12">
                        <div class="row border-top border-light-grey whited pt-1">
                            @foreach($permissionsItems as $perm)
                                <?php
                                $per_found = null;

                                if (isset($role)) {
                                    $per_found = $role->hasPermissionTo($perm->name);
                                }

                                if (isset($user)) {
                                    $per_found = $user->hasDirectPermission($perm->name);
                                }
                                ?>

                                <div class="col-md-3">
                                    <div class="checkbox">
                                        <label class="{{ Str::contains($perm->name, 'delete') ? 'text-danger' : '' }}">
                                            {!! Form::checkbox("permissions[]", $perm->name, $per_found, isset($options) ? $options : []) !!} {{ $perm->getNameForRead() }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
