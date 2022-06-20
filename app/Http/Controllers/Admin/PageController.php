<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\DataContainers\Page\PageSearchRequest;
use App\Enum\PageTypeEnum;
use App\Http\Requests\Admin\PageRequest;
use App\Models\Admin\Photo;
use App\Models\Page\Page;
use App\Repositories\PageRepository;
use App\Services\Admin\Page\PageShowFieldsContainer;
use App\Services\Admin\Page\PageShowFieldsService;
use App\Traits\Authorizable;
use App\Traits\Controllers\SaveImageTrait;
use Illuminate\Http\Request;

class PageController extends AdminController
{
    use SaveImageTrait;
    use Authorizable;

    private $name;

    protected $key = 'pages';

    protected $permissionKey = 'pages';

    protected $routeKey = 'admin.pages';

    private $repository;

    public function __construct(PageRepository $repository)
    {
        parent::__construct();
        $this->name = __('modules.pages.title');
        $this->addBreadCrumb($this->name, $this->resourceRoute('index'));
        $this->shareViewModuleData();
        $this->repository = $repository;
    }

    public function index(Request $illuminateRequest, PageSearchRequest $request, PageRepository $pageRepository)
    {
        $request->fillFromRequest($illuminateRequest);
        $this->setTitle($this->name);
        $list = $pageRepository->getListAdmin($request);
        $with = compact(array_keys(get_defined_vars()));

        $data['content'] = view('admin.pages.index')->with($with);

        return $this->main($data);
    }

    public function create(PageRepository $pageRepository, PageShowFieldsContainer $container)
    {
        $pageTypes = PageTypeEnum::getEnums();
        $list = $pageRepository->getForAdmin();
        $with = compact(array_keys(get_defined_vars()));
        $data['content'] = view('admin.pages.create')->with($with);

        return $this->main($data);
    }

    public function store(PageRequest $request)
    {
        $input = $request->except('image');
        if ($page = $this->repository->create($input)) {
            $this->setSuccessStore();
            $this->saveImage($request, $page);
        }

        return $this->redirectOnCreated($page);
    }

    public function edit(Page $page)
    {
        $container = (new PageShowFieldsService($page))->generate();
        $title = $this->titleEdit($page->lang, 'title');
        $this->addBreadCrumb($title)->setTitle($title);
        view()->share([
            'edit' => $page,
            'photosList' => $page->images,
            'container' => $container,
        ]);

        $data['content'] = view('admin.pages.edit');

        return $this->main($data);
    }

    public function update(PageRequest $request, Page $page)
    {
        $input = $request->except('image', 'sub_image');
        if ($this->repository->update($input, $page)) {
            $this->setSuccessUpdate();
        }

        $container = (new PageShowFieldsService($page))->generate();
        if ($container->isWithImage()) {
            $this->saveImage($request, $page);
            $this->saveImage($request, $page, 'sub_image');
        }

        return $this->redirectOnUpdated($page);
    }

    public function destroy(Page $page, Photo $photo)
    {
        if ($page->canDelete() && $page->delete()) {
            $photo->deleteImageStorage($page->getImage());
            $photo->deleteImageStorage($page->getAttribute('sub_image'));
            $this->setSuccessDestroy();
        }

        return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
    }

}
