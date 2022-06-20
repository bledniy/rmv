{{-- Короче тут проверка на локалку, меня этот прелоадер достал, на локалке он не отображается--}}
@if(getSetting('_.view.layout.enabled_preloader'))
    <div class="preloader" data-preloader>
        <div class="preloader__image">
            <img src="{{ asset('assets/img/Logo.gif') }}">
        </div>
    </div>
@endif