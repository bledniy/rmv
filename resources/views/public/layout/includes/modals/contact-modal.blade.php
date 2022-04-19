<div class="modal_bg contact-modal" id="contact-modal">
    <div class="container">
        <div class="contact-modal__wrapper">
            <div class="contact-modal__wrap">
                <h2 class="contact-modal__title">Связаться с нами</h2>
                <form class="contact-modal__form" action="{{ route('feedback.default') }}" method="POST">
                    @csrf
                    @includeIf('public.contacts.partials.contact-form-fields')
                    <button class="button-type-one send-data">Отправить</button>
                </form>
                <button class="button-type-none close-modal-support">
                    <img src="{{ asset('assets/img/close.svg') }}">
                </button>
            </div>
        </div>
    </div>
</div>