<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\DataContainers\News\SearchDataContainer;
use App\Models\News\News;
use App\Repositories\NewsRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class NewsController extends SiteController
{
    private $newsRepository;

    private $container;

    public function __construct(
        NewsRepository $newsRepository,
        SearchDataContainer $container,
        Request $request
    )
    {
        parent::__construct();
        $this->newsRepository = $newsRepository;
        $container->fillFromRequest($request);
        $this->container = $container->setOnPage(9);
    }

    public function index()
    {
        $news = $this->newsRepository->getListPublic($this->container);

        return view('public.news.index')->with(compact('news'));
    }

    public function show(string $id)
    {
        $item = $this->newsRepository->find((int)$id);

        return view('public.news.show')->with(compact('item'));
    }

    public function showModalRendered(News $news): JsonResponse
    {
        return new JsonResponse(view('public.layout.includes.modals.news-modal-content')->with(compact('news'))->render());
    }

    public function loadMore(): JsonResponse
    {
        $news = $this->newsRepository->getListPublic($this->container);
        $content = view('public.news.load-more')->with(compact('news'))->render();
        $res = [
            'html' => $content,
            'nextPageUrl' => $news->nextPageUrl(),
        ];

        return new JsonResponse($res);
    }

}