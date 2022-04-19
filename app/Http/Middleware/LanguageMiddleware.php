<?php

namespace App\Http\Middleware;

use App\Helpers\LanguageHelper;
use App\Models\Language;
use App\Repositories\Admin\LanguageRepository;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class LanguageMiddleware
{
    /**
     * @var LanguageRepository
     */
    private $repository;

    public function __construct(LanguageRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = $request->hasHeader('x-locale') ? $request->header('x-locale') : $request->get('__locale');
        LaravelLocalization::setLocale($locale);

        if (!LanguageHelper::getLanguageId()) {
            if (($locale = LaravelLocalization::getCurrentLocale()) && $language = $this->getLanguageByLangCode($locale)) {
                LanguageHelper::setLanguageId($language->getKey());
            } else if ($language = $this->getDefaultLanguage()) {
                LanguageHelper::setLanguageId($language->getKey());
            }
        }

        if (!LanguageHelper::getLanguageId()) {
            abort(404);
        }

        return $next($request);
    }

    protected function getLanguageByLangCode($langCode): ?Language
    {
        $cacheKey = 'languages.' . $langCode;

        return Cache::get($cacheKey, function () use ($cacheKey, $langCode) {
            $value = $this->repository->findOneByCode($langCode);
            Cache::set($cacheKey, $value, now()->addHour());

            return $value;
        });
    }

    protected function getDefaultLanguage(): Language
    {
        $cacheKey = 'languages.default';

        return Cache::get($cacheKey, function () use ($cacheKey) {
            $value = $this->repository->getDefaultLanguage();
            Cache::set($cacheKey, $value, now()->addHour());

            return $value;
        });
    }
}
