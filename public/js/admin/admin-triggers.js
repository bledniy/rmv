$(document).ready(function (e) {
    $(document).on('click', '.image-actions .delete-image-btn', function (e) {
        if (confirm('Удалить фото?')) {
            $image = $(this).parent().find('.deleteable')[0];
            console.log($image);
            deletePhoto($image);
        }
    });
    $(document).on('click', '.image-actions .get-crop-btn', function (e) {
        $image = $(this).parent().find('.croppable')[0];
        getEditPhotoForCrop($image);
    });
//
    $('[data-flatpickr-type="datetime_local"]').flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        time_24hr: true
    });
    $('[data-flatpickr-type="date"]').flatpickr({
        enableTime: false,
        dateFormat: "Y-m-d",
    });
    $('[data-flatpickr-type="time"]').flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true
    });
    $('[data-flatpickr-type="default"]').flatpickr({
        time_24hr: true
    });
    //
    const $fancy = $("a.fancy");
    if ($fancy.length) {
        $fancy.fancybox();
    }

    //
    const $changeSelector = '[data-send-only-changed]';
    const $changedSelector = $changeSelector + ' input, ' + $changeSelector + ' textarea, ' + $changeSelector + ' select';
    $(document).on('submit', $changeSelector, function (e) {
        const $this = $(this);
        // if ($this.find('.was-changed').length === 0) {
        // 	e.preventDefault();
        // 	message('Данные не изменены, нечего обновлять', 'warning');
        // } else {
        const $except = ':not(.was-changed):not([type="hidden"]):not([data-send-no-disable])';
        $formFields = $this.find('input' + $except + ', select' + $except + ', textarea' + $except);
        $formFields.prop('disabled', true);
        // }
    });
    $(document).on('change input', $changedSelector, function (e) {
        if (!$(this).hasClass('was-changed')) {
            $(this).toggleClass('was-changed');
        }
    });

    let formDeleteConfirmAlreadyDone = false
    $(document).on('submit', '.formDeleteConfirm', function (e) {
        if (!formDeleteConfirmAlreadyDone) {
            e.preventDefault();
            const $this = $(this);
            const $cb = function (confirmed) {
                if (confirmed) {
                    formDeleteConfirmAlreadyDone = true;
                    $this.trigger('submit');
                }
            }
            modalActions($cb)
        }
    });

    let formActionConfirmAlreadyDone = false
    $(document).on('submit', '.formActionConfirm', function (e) {
        if (!formActionConfirmAlreadyDone) {
            e.preventDefault();
            const $this = $(this);
            const $textModal = $this.attr('data-modal-text') || ''
            const $cb = function (confirmed) {
                if (confirmed) {
                    formActionConfirmAlreadyDone = true;
                    $this.trigger('submit');
                }
            }
            modalActions($cb, $textModal)
        }
    });

    $(document).on('submit', '[data-form-confirm]', function (e) {
        if (!confirm('Are you sure?')) {
            e.preventDefault();
        }
    });

    $('[data-url-update]').on('change', function (e) {
        const $url = $(this).data('url-update');
        const $name = $(this).attr('name');
        const $data = {}
        $data[$name] = $(this).val()

        const $method = $(this).data('method') ?? 'PATCH';
        $.ajax({type: $method, url: $url, data: $data}).then((res) => {
            messageResponse(res)
        })
    })

   // const updateSidebarCounters = function (){
   //      $.get('/admin/dashboard/counters').then((res) => {
   //          const menus = $('.sidebar-menu .nav-link')
   //          $.each(res, ($key, $counter) => {
   //              menus.each((u, $menu) => {
   //                  if ($($menu).attr('href') === $key) {
   //                      $($menu).find('p .counter').remove();
   //                      if ($counter) {
   //                          $($menu).find('p').append(` <span class="counter badge badge-danger">${$counter}</span>`)
   //                      }
   //                  }
   //              })
   //          })
   //      })
   //  };
   //  updateSidebarCounters();
   //  setInterval(updateSidebarCounters, 8000)

});
