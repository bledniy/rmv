<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Meta;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

abstract class SiteController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->addBreadCrumb(getSetting('global.home-bread-name'), route('home'));
        $this->checkForCanonical();
    }

    public function main($data = [])
    {
        /** @var  $view */
        $view = view('public.layout.app', $data);

        return $view;
    }

    public function callAction($method, $parameters)
    {
        $this->preCallAction();
        $res = parent::callAction($method, $parameters);
        $this->postCallAction();

        return $res;
    }

    protected function preCallAction()
    {
        $this->checkMetaData();
    }

    protected function postCallAction()
    {
    }

    public function checkMetaData(): void
    {
        if ($metadata = Meta::getMetaData()) {
            if ($metadata->title) {
                $this->setTitle($metadata->title, true);
            }
            if ($metadata->description) {
                $this->setDescription($metadata->description, true);
            }
            if ($metadata->keywords) {
                $this->setKeywords($metadata->keywords, true);
            }

            return;
        }
        if ((!$this->getTitle() || !$this->getDescription() || !$this->getKeywords()) && ($meta_default = Meta::getDefaultMeta())) {
            if (!$this->getTitle()) {
                $this->setTitle($meta_default->title);
            }
            if (!$this->getDescription()) {
                $this->setDescription($meta_default->description);
            }
            if (!$this->getKeywords()) {
                $this->setKeywords($meta_default->keywords);
            }
        }
    }

    protected function checkForCanonical(): void
    {
        if (request()->has('page')) {
            $this->setCanonical(url()->current());
        }
    }

    protected function setNextPrevLinkForPagination(LengthAwarePaginator $paginator): void
    {
        $nextUrl = $paginator->nextPageUrl();
        $prevUrl = $paginator->previousPageUrl();

        if ($paginator->currentPage() === 2) {
            $this->setPrev(url()->current());
        } else if ($prevUrl !== null) {
            $this->setPrev($prevUrl);
        }
        if ($paginator->hasMorePages()) {
            $this->setNext($nextUrl);
        }
    }
}















