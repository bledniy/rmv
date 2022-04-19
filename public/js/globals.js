$(document).ready(function (e) {
    $('[data-confirm]').on('click', function(e){
        if(confirm('Удалить элемент??')){
            if(!confirm('Ты точно не пьян?'))
                e.preventDefault()
        } else  e.preventDefault()
    });
});
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});