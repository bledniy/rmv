<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enum\ContentTypeEnum;
use App\Repositories\ContentRepository;

class CooperationController extends SiteController
{
    /**
     * @var ContentRepository
     */
    private $contentRepository;

    public function __construct(ContentRepository $contentRepository)
    {
        parent::__construct();
        $this->contentRepository = $contentRepository;
    }

    public function index()
    {
        $list = $this->contentRepository->getListPublicByType(ContentTypeEnum::COOPERATION);
        $with = compact(array_keys(get_defined_vars()));

        return view('public.cooperation.index')->with($with);
    }
}
