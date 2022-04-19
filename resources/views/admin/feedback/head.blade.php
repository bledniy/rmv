<?php /** @var $searchDataContainer \App\DataContainers\Admin\Feedback\SearchDataContainer */ ?>
<?php /** @var $types \App\Enum\FeedbackTypeEnum[] */ ?>

<form action="" method="get">
    <div class="form-group">
        <div class="row">
            <div class="col-8 mt-3">
                <input type="text" class="form-control" name="search" value="{{ $searchDataContainer->getSearch() }}" autocomplete="off">
            </div>
            <div class="col-2">
                <select name="type" id="type" class="form-control selectpicker" autocomplete="off" onchange="this.form.submit()">
                    <option value="">Выберите тип </option>
                    @foreach($types as $type)
                        <option value="{{ $type->getKey() }}"
                                @if(old('group', $searchDataContainer->getType()) === $type->getKey()) selected="" @endif
                        >{{ $type->getTitle() }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-2">
                <button class="btn btn-danger" type="submit"><i class="fa fa-search" aria-hidden="true"></i>
                    @lang('form.search')
                </button>
            </div>
        </div>
    </div>
</form>
