<?php /** @var $menuGroups \App\Enum\MenuGroupEnum[] */ ?>
<div class="form-group">
    <label for="icon" class="control-label">Группа</label>

    <div class="w-25">
        <select name="group" id="group" class="form-control selectpicker" required="" autocomplete="off">
            <option value="">Выберите группу</option>
            @foreach($menuGroups as $menuGroup)
                <option value="{{ $menuGroup->getKey() }}"
                    @if((int)old('group') === $menuGroup->getKey()) selected="" @endif
                >{{ $menuGroup->getTitle() }}</option>
            @endforeach
        </select>
    </div>
</div>