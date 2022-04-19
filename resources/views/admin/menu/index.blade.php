<?php /** @var $list \App\DataContainers\Menu\MenuGroupData[] */ ?>
<?php /** @var $loop \App\Helpers\Dev\BladeLoopAutocompleteHelper*/ ?>
<div class="row">
    <div class="col-6 text-right">
        <a href="{{ route($routeKey . '.create') }}" class="btn btn-primary">@lang('form.create')</a>
    </div>
</div>

<ul class="nav nav-tabs my-5" role="tablist">
    @foreach($list as $group)
        <li class="nav-item">
            <a class="nav-link text-dark {{ $loop->first ? 'active' : '' }}" id="feedback-tab" data-toggle="tab"
               href="#group-menu-{{ $group->getGroupEnum()->getKey() }}" role="tab"
               aria-controls="group-feedback" aria-selected="true">{{ $group->getGroupEnum()->getTitle() }}</a>
        </li>
    @endforeach
</ul>

<div class="tab-content">
    @foreach($list as $group)
        <div class="tab-pane {{ $loop->first ? 'active' : '' }}" id="group-menu-{{ $group->getGroupEnum()->getKey() }}" role="tabpanel">
            <div class="dd menu">
                @include('admin.menu.partials.menu-loop', ['menus' => $group->getMenus()])
            </div>
        </div>
    @endforeach
</div>

<script>
    $(document).ready(function () {
        const nestableUrl = '{{ route('admin.menu.nesting') }}';
        $('.dd').each(function (i, elm) {
            $(elm).nestable({
                maxDepth:1,
                callback: function (l, e) {
                    $serialized = $(l).nestable('serialize');
                    updateNesting($serialized);
                }
            });
        })
        function updateNesting(data) {
            const $data = {
                'menus': data,
            };
            $.post(nestableUrl, $data,
                function (data) {
                    if (data.message) {
                        let $status = (data.status) ? 'success' : 'error';
                        message(data.message, $status);
                    }
                })
        }
    });
</script>
