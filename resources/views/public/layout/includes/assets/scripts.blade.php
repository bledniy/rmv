@yield('js-before')

@stack('js-before')

@include('public.layout.includes.assets.js-libraries')

@include('partials.flash-message')

{{-- Scripts from another templates, which "extends" this --}}
@yield('js')

@stack('js')

<!-- meta footer -->
{!! showMeta('', 'footer') !!}
<!-- end meta footer -->