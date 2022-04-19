<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin\Meta;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\MetaRequest;
use App\Models\Meta;
use App\Repositories\MetaRepository;
use App\Traits\Authorizable;
use Illuminate\Http\Request;

class MetaController extends AdminController
{

    use Authorizable;

    protected $key = 'meta';
    protected $routeKey = 'admin.meta';
    protected $permissionKey = 'meta';
    protected $name = 'SEO';
    /**
     * @var MetaRepository
     */
    private $repository;

    public function __construct(MetaRepository $repository)
    {
        parent::__construct();
        $this->addBreadCrumb($this->name, $this->resourceRoute('index'));
        $this->shareViewModuleData();
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        \View::share('request', $request);
        $this->setTitle($this->name);
        $vars['list'] = $this->repository->getForAdminDisplay($request);
        $data['content'] = view('admin.meta.index', $vars);

        return $this->main($data);
    }

    public function create(Request $request)
    {
        if ($request->has('url')) {
            $request->merge(['url' => Meta::makeUrlClear($request->get('url'))]);
            $metaExisted = $this->repository->findByUrl((string)$request->get('url'));
            if ($metaExisted) {
                return redirect($this->resourceRoute('edit', $metaExisted->getKey()));
            }
        }
        $with = compact(array_keys(get_defined_vars()));
        $data['content'] = view('admin.meta.create')->with($with);

        return $this->main($data);
    }

    public function store(MetaRequest $request)
    {
        if ($meta = $this->repository->create($request->only($request->getFillableFields()))) {
            $this->setSuccessStore();
        }
        if ($request->has('createOpen')) {
            return redirect($this->resourceRoute('edit', $meta->getKey()))->with($this->getResponseMessage());
        }

        return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
    }

    public function edit($id)
    {
        $edit = Meta::with('lang')->findOrFail($id);
        $title = $this->titleEdit($edit, 'url');
        $this->setTitle($title)->addBreadCrumb($title);
        $with = compact(array_keys(get_defined_vars()));

        $data['content'] = view('admin.meta.edit')->with($with);

        return $this->main($data);
    }

    public function update(MetaRequest $request, Meta $meta)
    {
        $input = $request->all();
        if (!isSuperAdmin()) {
            unset($input['url']);
        }

        if ($this->repository->update($input, $meta)) {
            $this->setSuccessUpdate();
        }
        if ($request->has('saveClose')) {
            return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
        }

        return redirect()->back()->with($this->getResponseMessage());
    }

    public function destroy(Meta $meta)
    {
        if ($meta->delete()) {
            $this->setSuccessDestroy();
        }

        return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
    }
}
