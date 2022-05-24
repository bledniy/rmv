<div class="modal fade action-item-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Подтвердите действие</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning delete-item-btn" data-action-confirm="true" data-dismiss="modal">Да</button>
                <button type="button" class="btn btn-primary delete-item-btn" data-action-confirm="false" data-dismiss="modal">Нет</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    const APP_URL = '{{ env('APP_URL') }}';
    const ADMIN_URL = '{{ config('app.admin-url', 'admin') }}'
</script>

<script type="text/javascript" src="{{ mix('_admin/js/libraries.js') }}" defer></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js" defer></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/flatpickr@4.5.7/dist/flatpickr.min.js" defer></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

{{--todo move to single file--}}
<script type="text/javascript" src="{{ asset('_admin/js/ckeditor/ckeditor.js') }}" defer></script>
<script type="text/javascript" src="{{ assetVersioned('js/globals.js') }}" defer></script>
<script type="text/javascript" src="{{ assetVersioned('js/functions.js') }}" defer></script>
<script type="text/javascript" src="{{ assetVersioned('js/admin/functions-admin.js') }}" defer></script>
<script type="text/javascript" src="{{ assetVersioned('js/admin/admin-triggers.js') }}" defer></script>
<script type="text/javascript" src="{{ assetVersioned('js/admin/admin-init.js') }}" defer></script>
<script type="text/javascript" src="{{ assetVersioned('js/init.js') }}" defer></script>
<script type="text/javascript" src="{{ assetVersioned('libs/nestable2/jquery.nestable.min.js') }}" defer></script>
<script type="text/javascript" src="{{ mix('_admin/static/js/script.js') }}"></script>

<script type="text/javascript" defer>
    $(document).ready(function (e) {
        const $sort = sort.getInstance();
        $sort.url = '{{ route('sort') }}';
        $sort.init();
    });
</script>

@stack('js')

@yield('javascript')
