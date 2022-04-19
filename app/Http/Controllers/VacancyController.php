<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\DataContainers\Vacancies\VacancyData;
use App\Enum\ContentTypeEnum;
use App\Models\Content\Content;
use App\Repositories\ContentRepository;

class VacancyController extends SiteController
{
    private $contentRepository;

    public function __construct(
        ContentRepository $contentRepository
    )
    {
        parent::__construct();
        $this->contentRepository = $contentRepository;
    }

    public function index()
    {
        $vacancies = $this->contentRepository->getListPublicByType(ContentTypeEnum::VACANCY);
        $vacancies = $vacancies->map(function (Content $content) {
            return VacancyData::createFromContent($content);
        });
        $with = compact(array_keys(get_defined_vars()));

        return view('public.vacancies-page')->with($with);
    }
}
