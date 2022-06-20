<?php

return [
	'supportedLocales' => [
		'ru' => ['name' => 'Russian', 'script' => 'Cyrl', 'native' => 'Русский', 'regional' => 'ru_RU'],
//		'en' => ['name' => 'English', 'script' => 'Latn', 'native' => 'English', 'regional' => 'en_GB'],
		'uk' => ['name' => 'Ukrainian', 'script' => 'Cyrl', 'native' => 'Українська', 'regional' => 'uk_UA'],
	],

	'useAcceptLanguageHeader' => true,

	'hideDefaultLocaleInURL' => true,

	//Example: 'localesOrder' => ['es','en'],
	'localesOrder'           => [],

	//  If you want to use custom lang url segments like 'at' instead of 'de-AT', you can use the mapping to tallow the LanguageNegotiator to assign the descired locales based on HTTP Accept Language Header. For example you want ot use 'at', so map HTTP Accept Language Header 'de-AT' to 'at' (['de-AT' => 'at']).
	'localesMapping'         => [],

	'utf8suffix' => env('LARAVELLOCALIZATION_UTF8SUFFIX', '.UTF-8'),

	'urlsIgnored' => ['/skipped'],

];
