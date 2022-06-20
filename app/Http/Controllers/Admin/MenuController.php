<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Enum\MenuGroupEnum;
use App\Events\Admin\MenusChanged;
use App\Http\Requests\Admin\MenuRequest;
use App\Models\Admin\Photo;
use App\Models\Menu;
use App\Repositories\MenuRepository;
use App\Services\Admin\Nestable\DefaultNestableService;
use App\Services\Menu\MenusServiceInterface;
use App\Traits\Authorizable;
use App\Traits\Controllers\SaveImageTrait;
use App\Traits\Controllers\ThumbnailSizes;
use Illuminate\Http\Request;

class MenuController extends AdminController
{
    use ThumbnailSizes;
    use SaveImageTrait;
    use Authorizable;

    public $thumbnailWidth = false;
    public $thumbnailHeight = false;

    protected $routeKey = 'admin.menu';

    protected $permissionKey = 'menu';

    private $name;

    protected $key = 'menu';

    private $repository;
    /**
     * @var MenusServiceInterface
     */
    private $menusService;

    public function __construct(MenuRepository $repository, MenusServiceInterface $menusService)
    {
        parent::__construct();
        $this->name = __('modules.menu.title');
        $this->addBreadCrumb($this->name, $this->resourceRoute('index'));
        $this->shareViewModuleData();
        $this->repository = $repository;
        view()->share(['menuGroups' => MenuGroupEnum::getEnums()]);
        $this->menusService = $menusService;
    }

    public function index()
    {
        $this->setTitle($this->name);
        $list = $this->menusService->getAllMenus();
        $with = compact(array_keys(get_defined_vars()));
        $data['content'] = view('admin.menu.index')->with($with);

        return $this->main($data);
    }

    public function create()
    {
        $vars['menus'] = Menu::getForDisplayEdit();
        $data['content'] = view('admin.menu.create')->with($vars);

        return $this->main($data);
    }

    public function store(MenuRequest $request)
    {
        $input = $request->except('image');

        if ($menu = $this->repository->create($input)) {
            $this->setSuccessStore();
            $this->fireEvents();
        }
        $this->saveImage($request, $menu);
        if ($request->has('createOpen')) {
            return redirect($this->resourceRoute('edit', $menu->getKey()))->with($this->getResponseMessage());
        }

        return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
    }

    public function edit($id)
    {
        $vars['edit'] = Menu::with('lang')->findOrFail($id);
        $title = $this->titleEdit($vars['edit']);
        $this->addBreadCrumb($title)->setTitle($title);

        $vars['menus'] = Menu::getForDisplayEdit();
        $data['content'] = view('admin.menu.edit', $vars)->with($vars);

        return $this->main($data);
    }

    public function update(MenuRequest $request, Menu $menu)
    {
        $input = $request->all();
        if ($this->repository->update($input, $menu)) {
            $this->setSuccessUpdate();
            $this->saveImage($request, $menu);

            $this->fireEvents();
        }
        if ($request->has('saveClose')) {
            return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
        }

        return redirect()->back()->with($this->getResponseMessage());
    }

    public function destroy(Menu $menu, Photo $photo)
    {
        if (!$menu->canDelete()) {
            $this->setFailMessage('Нельзя удалить это меню');
        } else if ($menu->canDelete() && $menu->delete()) {
            $photo->deleteImageStorage($menu->getImage());
            $this->setSuccessDestroy();
            $this->fireEvents();
        }

        return back()->with($this->getResponseMessage());
    }

    public function nesting(Request $request)
    {
        app(DefaultNestableService::class, ['modelClassName' => Menu::class])->nestable($request->get('menus'));
        $this->fireEvents()->setSuccessUpdate();

        return $this->getResponseMessageForJson();
    }

    protected function fireEvents(): self
    {
        event(new MenusChanged);

        return $this;
    }
}
