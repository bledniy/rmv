function saveCroppedPhoto($image) {
    if (!$image) return false;
    // $image = $($image);
    var $id = $image.data('image-id') || '';
    var $table = $image.data('image-table') || '';
    var $base64 = $image.inBase64 || '';
    var $primaryId = $image.data('primary-id') || false;
    var $directory = $image.data('image-directory') || false;
    var $query = 'id=' + $id + '&table=' + $table + '&base64=' + $base64;
    if ($primaryId) $query += '&primary_id=' + $primaryId;
    if ($directory) $query += '&directory=' + $directory;
    $.ajax({
        url: appUrl(adminUrl('/photos/edit')),
        data: $query,
        dataType: "json",
        cache: false,
        method: 'post',
        success: function ($data) {
            messageResponse($data);
            if ($data.status) {
                $updatePhotos = $('[data-image-id="' + $id + '"]');
                updateImageUrl($updatePhotos, $data.image);
                if ($updatePhotos.length) {
                    console.log($updatePhotos)
                    $('#cropWrapperModal').modal('hide');
                    $.each($updatePhotos, function ($key, $image) {
                        $src = $($image).attr('src');
                        $src = $src.split('?')[0];
                        $src = $src + '?' + time();
                        $($image).attr('src', $src);
                    })
                }
            }
        }
    });
}

function updateImageUrl($image, $url) {
    if ($url) {
        $image.attr('src', $url);
    }
}

function getEditPhotoForCrop($image) {
    if (!$image) return false;
    $image = $($image);
    $cropWrapperModal = $('.cropWrapperModal');
    if (!$cropWrapperModal.length) $('body').append('<div class="cropWrapperModal"></div>');
    else $cropWrapperModal.html('');

    $id = $image.data('image-id') || '';
    $table = $image.data('image-table') || '';
    $primaryId = $image.data('primary-id') || false;
    var $directory = $image.data('image-directory') || false;
    $query = 'id=' + $id + '&table=' + $table;
    if ($directory) $query += '&directory=' + $directory;
    if ($primaryId) $query += '&primary_id=' + $primaryId;
    $.ajax({
        url: appUrl(adminUrl('/photos/get-cropper')),
        data: $query,
        dataType: "json",
        cache: false,
        method: 'post',
        success: function ($data) {
            messageResponse($data);
            $('.cropWrapperModal').html($data.content);
            $('#cropWrapperModal').modal();
        }
    });
}

function deletePhoto($image) {
    if (!$image) return false;
    $image = $($image)
    $id = $image.data('image-id') || '';
    $table = $image.data('image-table') || '';
    $primaryId = $image.data('primary-id') || false;
    $query = 'id=' + $id + '&table=' + $table;
    if ($primaryId) $query += '&primary_id=' + $primaryId;
    $.ajax({
        url: appUrl(adminUrl('/photos/delete')),
        data: $query,
        dataType: "json",
        cache: false,
        method: 'post',
        success: function ($data) {
            messageResponse($data);
            if ($data.status === 'success') {
                $image.parents('.image-actions').remove();
            }
        }
    });
}

sort = {
    getInstance: function () {
        return Object.assign({}, this);
    },
    'container': '[data-sortable-container]',
    'handle': '.handle',
    'draggable': '.draggable',
    'single': '[data-sort]',
    'url': appUrl(adminUrl('/ajax/sort')),
    'init': function () {
        $this = this;
        $sortable = document.querySelectorAll(this.container);
        if (!$sortable.length) return false;
        $sortable.forEach(function ($container) {
            Sortable.create($container, {
                draggable: $this.draggable,
                handle: $this.handle,
                onUpdate: $this.onUpdateSort
            });

        });
    },
    'onUpdateSort': function (e) {
        $sortArray = [];
        $wrapper = $(e.target);
        $table = $wrapper.data('table');
        $rows = $wrapper.find($this.single);
        $.each($rows, function ($key, $row) {
            $id = $($row).data('id');
            $sortArray[$key] = $id;
        });
        if ($sortArray && $table) {
            $this.update($table, $sortArray);
        }
    },
    'update': function ($table, $sortArray) {
        $this = this;
        if (!$table || !$sortArray) return false;
        let $query = '';
        $sortArray = JSON.stringify($sortArray);
        $query = 'sort=' + $sortArray + '&' + 'table=' + $table;
        $.post({
            url: $this.url,
            data: $query,
            dataType: "json",
            cache: false,
            success: function (res) {
                if (res.status === 'success') {
                    $this.onUpdateSuccess(res);
                }
            }
        });
    },
    'onUpdateSuccess': function (data) {
        messageResponse(data);
    }
};

function deleteItemRequest($item, $callback) {
    const $this = $($item);
    const $id = $this.data('id');
    const $table = $this.data('table');
    const $data = {
        'id': $id,
        'table': $table
    };
    const $url = appUrl(adminUrl('/ajax/delete'));
    if ($table && $id) {
        $.post($url, $data)
            .done(function (data) {
                if (data.status === 'success') {
                    $this.parents('[data-deleteable-row]').remove();
                }
                if (typeof $callback === 'function') {
                    $callback();
                }
            })
            .always(function (data) {
                messageResponse(data)
            });
    }
}

function modalActions(callback, $text = 'Вы хотите удалить это?') {
    const $modal = $('.action-item-modal')
    $modal.find('.modal-body').text($text)
    $modal.modal('show');
    let isClosed = false
    $('[data-action-confirm]').off('click')
        .on('click', function () {
            isClosed = ($(this).attr('data-action-confirm') === 'true')
            callback(isClosed)
        })
    // return isClosed
}

function deleteItem($item, $callback) {
    modalActions((res) => {
        if (res) {
            console.log($item);
            deleteItemRequest($item, $callback)
        }
    })
}

function copyClickBoard($elm) {
    $elm = $($elm);
    let $originVal = $elm.val();
    let $text = '';
    let $prep = $elm.attr('data-prepend');
    if (typeof $prep !== 'undefined') {
        $text = $prep;
    }
    $text += $originVal;
    let $append = $elm.attr('data-append');
    if (typeof $append !== 'undefined') {
        $text += $append;
    }
    $elm.val($text);

    /* Select the text field */
    $elm.focus();
    $elm.select();

    /* Copy the text inside the text field */
    if (document.execCommand("copy")) {
        message('Content copied to clipboard.');
    }

    if ($text !== $originVal) {
        $elm.val($originVal);
    }

}