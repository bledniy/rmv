<?php /** @var $languages \App\Models\Language[]*/ ?>
@isset($languages)
    @if (count($languages) > 1 && getSetting('_.languages.show_list'))
        <div class="localisation-block">
            <div class="dropdown">
                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="true">
                    <img src="{{asset('/_admin/images/staff/flags/' .  getCurrentLocaleCode()  . '.png')}}" alt="">
                    <span class="d-inline-block ml-1">{{ LaravelLocalization::getCurrentLocale() }}</span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    @foreach($languages as $language)
                        @if($language->key !== getCurrentLocaleCode())
                            <li>
                                <a rel="alternate" hreflang="{{ $language->key }}" class="dropdown-item"
                                   href="{{ langUrl(null, $language->key) }}">
                                    <img src="{{ asset('/_admin/images/staff/flags/' . $language->key . '.png') }}" alt=""
                                         class="langIcon">
                                    <span class="d-inline-block ml-1">{{ \Illuminate\Support\Str::upper($language->key)}}</span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
@endisset