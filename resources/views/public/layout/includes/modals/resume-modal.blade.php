<div class="modal_bg cv-modal" id="cv-modal">
    <div class="container">
        <div class="contact-modal__wrapper">
            <div class="contact-modal__wrap">
                <h2 class="contact-modal__title">Оставить резюме</h2>
                <form class="contact-modal__form" action="{{ route('feedback.vacancy') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="vacancy_id" id="modal-vacancy-id" value="">
                    @includeIf('public.contacts.partials.contact-form-fields')
                    <label class="input-type-one cv-modal__label" for="upload-cv">
                        {!! errorDisplay('files') !!}
                        <img src="{{ asset('assets/img/cv.svg') }}">
                        <p>Прикрепите файл с резюме (doc/pdf до 10мб)</p>
                        <input accept="application/pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, text/plain" class="cv-modal__file"
                               id="upload-cv"
                               name="files[]" required="required" type="file">
                    </label>
                    <button class="button-type-one">Отправить</button>
                </form>
                <button class="button-type-none close-modal-cv">
                    <img src="{{ asset('assets/img/close.svg') }}" alt="">
                </button>
            </div>
        </div>
    </div>
</div>