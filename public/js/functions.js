function time() {
    return Math.round((new Date()).getTime() / 1000);
}

function appUrl($url) {
    return APP_URL + $url;
}

function adminUrl($url) {
    return '/' + ADMIN_URL + $url;
}


function langUrl($url) {
    if ($locale.length) $url = '/' + $locale + $url;
    return $url;
}

function bootstrapAlert($text, $type = 'info') {
    if ($type === 'error') {
        $type = 'danger';
    }
    return '<div class="alert alert-' + $type + '">' + $text + '</div>';
}

function message($text, $type) {
    if (typeof $type === 'undefined') {
        $type = 'info';
    }
    $.notify($text, {
        type: $type,
        mouse_over: 'pause',
        delay: 10 * 1000,
        z_index: 1600,
        placement: {
            from: "bottom",
            align: "left"
        },
    });
}

function messageErrorsFromResponse(errors) {
    $.each(errors, function ($key, $errorBag) {
        $.each($errorBag, function ($key, $message) {
            message($message, 'danger');
        })
    });
}


function messageResponse(res) {
    if (res.status === 'error') {
        res.status = 'danger';
    }
    if (typeof res.message !== 'undefined') {
        message(res.message, res.status);
    }
}

function appendMessagesToFormFromRequest(form, responseMessages) {
    messageErrorsFromResponse(responseMessages);
    $form = $(form);
    consoleLog(responseMessages);
    Object.keys(responseMessages).forEach(function (messages, key) {

    })
}

function consoleLog() {
    Array.prototype.slice.call(arguments).forEach(function (value, key) {
        if (window.APP_DEBUG === undefined || window.APP_DEBUG === true){
            console.log(value)
        }
    })
}
