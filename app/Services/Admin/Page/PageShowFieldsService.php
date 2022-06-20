<?php declare(strict_types=1);

namespace App\Services\Admin\Page;

use App\Models\Page\Page;

final class PageShowFieldsService
{
    private $page;

    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    public static function create(Page $page): PageShowFieldsService
    {
        return new  self($page);
    }

    public function generate(): PageShowFieldsContainer
    {
        $container = new PageShowFieldsContainer;
        $container->setWithImage($this->page->getTypeEnum()->isAbout());

        return $container;
    }
}