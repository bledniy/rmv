<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin\Content;

use App\Contents\ContentFieldsList;
use App\Contents\AbstractContentFieldsList;
use App\Contents\ContentFieldsTypeInterface;
use App\Enum\ContentTypeEnum;
use App\Repositories\ContentRepository;
use App\Traits\Authorizable;

class MainPageContentController extends ContentController
{
    use Authorizable;

    protected $fields = [ContentFieldsTypeInterface::IMAGE, ContentFieldsTypeInterface::NAME, ContentFieldsTypeInterface::DESCRIPTION, ContentFieldsTypeInterface::SORT];

    protected $routeKey = 'admin.';

    protected $name = 'Блоки Главной страницы';

    protected $permissionKey = 'main';


    public function __construct(ContentRepository $repository)
    {
        $this->routeKey .= $this->permissionKey = $this->contentType = ContentTypeEnum::MAIN;
        $contentFieldsList = (new ContentFieldsList($this->fields))->setContentTypeEnum(ContentTypeEnum::create($this->contentType));
        $contentFieldsList->addTitle(ContentFieldsTypeInterface::NAME, 'Название');
        app()->bind(AbstractContentFieldsList::class, function () use ($contentFieldsList) {
            return $contentFieldsList;
        });
        parent::__construct($repository, $contentFieldsList);
    }

}
