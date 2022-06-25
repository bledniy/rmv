<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\DataContainers\News\SearchDataContainer;
use App\Enum\ContentTypeEnum;
use App\Repositories\ContentRepository;
use App\Repositories\NewsRepository;

class HomeController extends SiteController
{
    private $contentRepository;

    public function __construct(ContentRepository $contentRepository)
    {
        parent::__construct();
        $this->contentRepository = $contentRepository;
    }

    public function home()
    {
        $blocks = $this->contentRepository->getListPublicByType('main');
        $with = compact(array_keys(get_defined_vars()));

        return view('public.home.index')->with($with);
    }
}
