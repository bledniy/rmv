@include('admin.partials.crud.default',
[
	'jsEvents' => 'onclick="copyClickBoard(this)"',
	'beforeInput' => '<div class="position-relative">',
	'afterInput' => '<i class="fa fa-clipboard" aria-hidden="true"></i></div>',
	'inputClass' => 'clickBoardCopy form-control',
])

