<?php

namespace App\Http\Controllers\Admin\News;

use App\Helpers\Media\ImageRemover;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\NewsRequest;
use App\Models\News\News;
use App\Repositories\NewsRepository;
use App\Services\Seo\MetaSearchService;
use App\Traits\Authorizable;
use App\Traits\Controllers\SaveImageTrait;
use function __;
use function redirect;
use function view;

class NewsController extends AdminController
{
    use Authorizable;
    use SaveImageTrait;

    public $thumbnailWidth = false;
    public $thumbnailHeight = false;

    private $name;

    protected $key = 'news';

    protected $routeKey = 'admin.news';

    protected $permissionKey = 'news';

    private $repository;

    private $metaSearchService;

    public function __construct(
        NewsRepository $repository,
        MetaSearchService $metaSearchService
    )
    {
        parent::__construct();
        $this->name = __('modules.news.title');
        $this->addBreadCrumb($this->name, $this->resourceRoute('index'));
        $this->shareViewModuleData();
        $this->repository = $repository;
        $this->metaSearchService = $metaSearchService;
    }

    public function index(NewsRepository $newsRepository)
    {
        $this->setTitle($this->name);
        $vars['list'] = $newsRepository->getListForAdmin();
        $data['content'] = view('admin.news.index', $vars);

        return $this->main($data);
    }

    public function create()
    {
        $data['content'] = view('admin.news.create');

        return $this->main($data);
    }

    public function store(NewsRequest $request)
    {
        $input = $request->only($request->getFillableFields('image'));
        if ($news = $this->repository->create($input)) {
            $this->setSuccessStore();
            $this->saveImage($request, $news);
            $this->fireEvents();
        }
        if ($request->has('createOpen')) {
            return redirect($this->resourceRoute('edit', $news->getKey()))->with($this->getResponseMessage());
        }

        return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
    }

    public function edit(News $news)
    {
        $edit = $this->repository->findForEdit($news->getKey());
        $this->addBreadCrumb($this->titleEdit($edit))->setTitle($this->titleEdit($edit));

        $with = compact(array_keys(get_defined_vars()));
        $data['content'] = view('admin.news.edit')->with($with);

        return $this->main($data);
    }

    public function update(NewsRequest $request, News $news)
    {
        $input = $request->only($request->getFillableFields('image'));
        //
        $this->saveImage($request, $news);
        if ($this->repository->update($input, $news)) {
            $this->setSuccessUpdate();
            $this->fireEvents();
        }

        if ($request->hasFile('images')) {
            $this->saveAdditionalImages($news, $request);
        }

        if ($request->has('saveClose')) {
            return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
        }

        return redirect()->back()->with($this->getResponseMessage());
    }

    public function destroy(News $news, ImageRemover $imageRemover)
    {
        if ($this->repository->delete($news->getKey())) {
            $imageRemover->removeImage($news->image);
            foreach ($news->getImages() as $image) {
                $imageRemover->removeImage($image->image);
            }
            $this->setSuccessDestroy();
            $this->fireEvents();
        }

        return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
    }

    private function fireEvents()
    {
    }
}
