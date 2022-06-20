@push('js')
    <script src="{{ asset('js/lib/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/lib/select2/ru.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.4/ace.js"></script>
    <script>
        $('document').ready(function () {
            $('#toggle_options').click(function () {
                $('.new-settings-options').toggle();
            });
            $('.panel-actions .voyager-trash').click(function () {
				const display = $(this).data('display-name') + '/' + $(this).data('display-key');
				$('#delete_setting_title').text(display);
                $('#delete_form')[0].action = '{{ route('settings.destroy', '__id') }}'.replace('__id', $(this).data('id'));
                $('#delete_modal').modal('show');
            });
            $('[data-toggle="tab"]').click(function () {
                $(".setting_tab").val($(this).html());
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".group_select").not('.group_select_new').select2({
                tags: true,
                width: 'resolve'
            });
            $(".group_select_new").select2({
                tags: true,
                width: 'resolve',
                placeholder: '{{ __("generic.select_group") }}'
            });
            // $(".group_select_new").val('').trigger('change');
        });
    </script>
    <script>
		const options_editor = ace.edit('options_editor');
		options_editor.getSession().setMode("ace/mode/json");
		const options_textarea = document.getElementById('options_textarea');
		options_editor.getSession().on('change', function () {
            console.log(options_editor.getValue());
            options_textarea.value = options_editor.getValue();
        });
    </script>
    <script type="text/javascript" defer>
        $(document).ready(function (e) {
            @foreach($settings->where('type', 'ckeditor') as $setting)
				{!! showEditor('settings-ckeditor-' . $setting->id) !!}
			@endforeach
        });
    </script>
@endpush