<?php declare(strict_types=1);

namespace App\Services\Seo;

interface SeoUrlRewriterInterface
{
    public function supportsRewrite(string $url): bool;

    public function rewrite(string $url): string;
}