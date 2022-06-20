<?php declare(strict_types=1);

namespace App\Services\Seo;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

final class ApiMetaRequestUrlRewriter implements SeoUrlRewriterInterface
{
    public function rewrite(string $url): string
    {
        $queryString = $this->movePerformerGetParametersToMainParameter($url);

        $requestPath = rtrim(parse_url($queryString, PHP_URL_PATH), '/');
        parse_str((string)parse_url($queryString, PHP_URL_QUERY), $getParams);

        $paramsAllowed = ['yuristy', 'onlajn', 'notarius', 'advokat'];
        foreach ($getParams as $param => $value) {
            if (in_array($param, $paramsAllowed, true)) {
                $requestPath .= '/' . $param;
            }
        }
        if (array_key_exists('city', $getParams)) {
            $requestPath = '/' . $getParams['city'] . $requestPath;
        }

        return $requestPath;
    }

    private function movePerformerGetParametersToMainParameter(string $queryString): string
    {
        //move other get parameters to parameter url (its link with get parameter)
        parse_str($queryString, $params);
        if (!array_key_exists('url', $params)) {
            return $queryString;
        }
        $otherParams = Arr::except($params, 'url');
        parse_str((string)parse_url(Arr::get($params, 'url'), PHP_URL_QUERY), $urlParameter);

        return parse_url(Arr::get($params, 'url'), PHP_URL_PATH) . '?' . http_build_query($urlParameter + $otherParams);
    }

    public function supportsRewrite(string $url): bool
    {
        return Str::contains(parse_url($url, PHP_URL_PATH), 'performers');
    }
}