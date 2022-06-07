@include('admin.partials.crud.elements.name', ['title' => 'Имя'])


    @include('admin.partials.crud.elements.image-upload-group')

<div class="row">
    <div class="col-3">
        @include('admin.partials.crud.elements.active')
    </div>
</div>

@include('admin.partials.crud.textarea.description')

@include('admin.partials.crud.js.init-description')

{{--@include('admin.partials.crud.textarea.excerpt')--}}


@include('admin.partials.crud.elements.email')

@include('admin.partials.crud.elements.phone')

@include('admin.partials.crud.select.select', ['list' => $departments,'name' => 'department_id', 'column' => 'name', 'title' => 'Отдел', 'nullable' => true])

<div class="form-group">
    <label for="type" class="control-label">Глава отдела</label>
    <div class="col px-0">
        <div class="check-styled {{ getCurrentLocaleCode() }}">
            <input type="checkbox" value="head" id="type"
                   autocomplete="off"
                   name="type"
                   @if (isset($edit)  && $edit->type === 'head') checked="checked" @endif
                    {!! $props ?? '' !!}
            />
            <label for="type"></label>
        </div>
    </div>
</div>

@include('admin.partials.crud.select.select', ['list' => $faculties,'name' => 'faculty_id', 'column' => 'name', 'title' => 'Факультет', 'nullable' => true])

<div class="form-group">
    <label for="sort_1" class="control-label">Глава Совета</label>
    <div class="col px-0">
        <div class="check-styled {{ getCurrentLocaleCode() }}">
            <input type="checkbox" value="1" id="sort_1"
                   autocomplete="off"
                   name="sort"
                   @if (isset($edit)  && $edit->sort === 1) checked="checked" @endif
                    {!! $props ?? '' !!}
            />
            <label for="sort_1"></label>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="sort_2" class="control-label">Заместитель главы Совета</label>
    <div class="col px-0">
        <div class="check-styled {{ getCurrentLocaleCode() }}">
            <input type="checkbox" value="2" id="sort_2"
                   autocomplete="off"
                   name="sort"
                   @if (isset($edit)  && $edit->sort === 2) checked="checked" @endif
                    {!! $props ?? '' !!}
            />
            <label for="sort_2"></label>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="sort_3" class="control-label">Секретарь Совета</label>
    <div class="col px-0">
        <div class="check-styled {{ getCurrentLocaleCode() }}">
            <input type="checkbox" value="3" id="sort_3"
                   autocomplete="off"
                   name="sort"
                   @if (isset($edit)  && $edit->sort === 3) checked="checked" @endif
                    {!! $props ?? '' !!}
            />
            <label for="sort_3"></label>
        </div>
    </div>
</div>
