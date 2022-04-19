<?php

namespace App\Console\Commands;

use App\Contracts\Models\HasSitemapLinks;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.xml';

    public function handle()
    {
        $sitemap = Sitemap::create();
        $classes = \Config::get('sitemap.providers', []);
        /** @var  $instance HasSitemapLinks */
        foreach ($classes as $class) {
            if (class_exists($class) && classImplementsInterface($class, HasSitemapLinks::class)) {
                try {
                    $instance = app($class);
                } catch (\Exception $e) {
                    app(LoggerHelper::class)->error($e);
                    continue;
                }
                $links = $instance->getSiteMapLinks();
                if (!$links) {
                    continue;
                }
                foreach ($links as $linkArr) {
                    try {
                        $sitemap->add(
                            Url::create($linkArr['loc'] ?? null)
                                ->setLastModificationDate($linkArr['lastmod'] ?? null)
                        );
                    } catch (\Exception $e) {
                    }
                }
            }
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));

        return 1;
    }
}
