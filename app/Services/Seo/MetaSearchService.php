<?php

namespace App\Services\Seo;

use App\Models\Meta;
use App\Repositories\MetaRepository;

class MetaSearchService
{
    private $seoUrlRewriter;

    private $metaRepository;

    public function __construct(
        SeoUrlRewriterInterface $seoUrlRewriter,
        MetaRepository $metaRepository
    )
    {
        $this->seoUrlRewriter = $seoUrlRewriter;
        $this->metaRepository = $metaRepository;
    }

    public function find(string $url): ?Meta
    {
        if ($this->seoUrlRewriter->supportsRewrite($url)) {
            $url = $this->seoUrlRewriter->rewrite($url);
        } else {
            $url = Meta::makeUrlClear($url);
        }

        return $this->metaRepository->findOneByUrl($url);
    }
}