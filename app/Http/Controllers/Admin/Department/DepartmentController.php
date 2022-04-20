<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin\Department;

use App\Helpers\Media\ImageRemover;
use App\Http\Controllers\Admin\AdminController;
use App\Models\Department\Department;
use App\Repositories\DepartmentRepository;
use App\Traits\Authorizable;
use App\Traits\Controllers\SaveImageTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Prettus\Validator\Exceptions\ValidatorException;

class DepartmentController extends AdminController
{
    use Authorizable;
    use SaveImageTrait;

    public $thumbnailWidth = false;
    public $thumbnailHeight = false;

    private $name;

    protected $key = '$department';

    protected $routeKey = 'admin.department';

    protected $permissionKey = '$department';
    /**
     * @var DepartmentRepository
     */
    private $repository;

    public function __construct(DepartmentRepository $repository)
    {
        parent::__construct();
        $this->name = __('modules.department.title');
        $this->addBreadCrumb($this->name, $this->resourceRoute('index'));
        $this->shareViewModuleData();
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(DepartmentRepository $departmentRepository)
    {
        $this->setTitle($this->name);
        $vars['list'] = $departmentRepository->getListForAdmin();
        $data['content'] = view('admin.department.index', $vars);

        return $this->main($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $data['content'] = view('admin.department.create');

        return $this->main($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     * @throws ValidatorException
     */
    public function store(Request $request)
    {
        $input = $request->only($request->getFillableFields('image'));
        if ($department = $this->repository->create($input)) {
            $this->setSuccessStore();
            $this->saveImage($request, $department);
            $this->fireEvents();
        }
        if ($request->has('createOpen')) {
            return redirect($this->resourceRoute('edit', $department->getKey()))->with($this->getResponseMessage());
        }

        return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Department $department
     * @return Application|Factory|View|Response
     */
    public function edit(Department $department)
    {
        $edit = $this->repository->findForEdit($department->getKey());
        $this->addBreadCrumb($this->titleEdit($edit))->setTitle($this->titleEdit($edit));

        $with = compact(array_keys(get_defined_vars()));
        $data['content'] = view('admin.department.edit')->with($with);

        return $this->main($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Department $department
     * @return RedirectResponse
     */
    public function update(Request $request, Department $department): RedirectResponse
    {
        $input = $request->only($request->getFillableFields('image'));
        //
        $this->saveImage($request, $department);
        if ($this->repository->update($input, $department)) {
            $this->setSuccessUpdate();
            $this->fireEvents();
        }

        if ($request->hasFile('images')) {
            $this->saveAdditionalImages($department, $request);
        }

        if ($request->has('saveClose')) {
            return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
        }

        return redirect()->back()->with($this->getResponseMessage());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Department $department
     * @param ImageRemover $imageRemover
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy(Department $department, ImageRemover $imageRemover)
    {
        if ($this->repository->delete($department->getKey())) {
            $imageRemover->removeImage($department->image);
            foreach ($department->getImages() as $image) {
                $imageRemover->removeImage($image->image);
            }
            $this->setSuccessDestroy();
            $this->fireEvents();
        }

        return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
    }
}
