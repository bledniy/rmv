<?php
if (!function_exists('getPreviewYoutubeFromLink')) {
    function getPreviewYoutubeFromLink($link, $imageSize = 'hqdefault')
    {
        $link = getYoutubeVideoCodeFromLink($link);

        return 'https://img.youtube.com/vi/' . $link . '/' . $imageSize . '.jpg';
    }
}

if (!function_exists('getYoutubeIframe')) {
    function getYoutubeIframe($link)
    {
        $code = getYoutubeVideoCodeFromLink($link);

        return '<iframe width="100%" height="100%" src="https://www.youtube.com/embed/' . $code . '"
			 frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" 
			 allowfullscreen></iframe>';
    }
}

if (!function_exists('getYoutubeVideoCodeFromLink')) {
    function getYoutubeVideoCodeFromLink($link): ?string
    {
        $isValidLink = (false !== strpos($link, 'https://youtu.be')) || (false !== strpos($link, 'youtube.com'));
        if (!$isValidLink) {
            return null;
        }

        if (strpos($link, 'https://youtu.be/') !== false) {
            return str_replace('https://youtu.be/', '', $link);
        }

        $queryStr = parse_url($link, PHP_URL_QUERY);
        parse_str($queryStr, $query);

        return $query['v'] ?? null;
    }
}


