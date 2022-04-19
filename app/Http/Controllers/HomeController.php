<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\DataContainers\News\SearchDataContainer;
use App\Enum\ContentTypeEnum;
use App\Repositories\ContentRepository;
use App\Repositories\NewsRepository;

class HomeController extends SiteController
{
    private $newsRepository;
    /**
     * @var ContentRepository
     */
    private $contentRepository;

    public function __construct(
        NewsRepository $newsRepository,
        ContentRepository $contentRepository
    )
    {
        parent::__construct();
        $this->newsRepository = $newsRepository;
        $this->contentRepository = $contentRepository;
    }

    public function home(
        SearchDataContainer $newsData
    )
    {
        $news = $this->newsRepository->getListPublic($newsData);
        $brands = $this->contentRepository->getListPublicByType(ContentTypeEnum::BRAND);
        $with = compact(array_keys(get_defined_vars()));

        return view('public.home.index')->with($with);
    }
}
