<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin\Staff;

use App\Helpers\Media\ImageRemover;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\StaffRequest;
use App\Models\Staff\Staff;
use App\Repositories\StaffRepository;
use App\Traits\Authorizable;
use App\Traits\Controllers\SaveImageTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Prettus\Validator\Exceptions\ValidatorException;

class StaffController extends AdminController
{
    use Authorizable;
    use SaveImageTrait;

    public $thumbnailWidth = false;
    public $thumbnailHeight = false;

    private $name;

    protected $key = 'staff';

    protected $routeKey = 'admin.staffs';

    protected $permissionKey = 'staff';
    /**
     * @var StaffRepository
     */
    private $repository;

    public function __construct(StaffRepository $repository)
    {
        parent::__construct();
        $this->name = __('modules.staffs.title');
        $this->addBreadCrumb($this->name, $this->resourceRoute('index'));
        $this->shareViewModuleData();
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(StaffRepository $staffRepository)
    {
        $this->setTitle($this->name);
        $vars['list'] = $staffRepository->getListForAdmin();
        $data['content'] = view('admin.staffs.index', $vars);

        return $this->main($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $data['content'] = view('admin.staffs.create');

        return $this->main($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StaffRequest $request
     * @return Application|RedirectResponse|Redirector
     * @throws ValidatorException
     */
    public function store(StaffRequest $request)
    {
        $input = $request->only($request->getFillableFields('image'));
        if ($staff = $this->repository->create($input)) {
            $this->setSuccessStore();
            $this->saveImage($request, $staff);
            $this->fireEvents();
        }
        if ($request->has('createOpen')) {
            return redirect($this->resourceRoute('edit', $staff->getKey()))->with($this->getResponseMessage());
        }

        return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Staff $staff
     * @return Application|Factory|View
     */
    public function edit(Staff $staff)
    {
        $edit = $this->repository->findForEdit($staff->getKey());
        $this->addBreadCrumb($this->titleEdit($edit))->setTitle($this->titleEdit($edit));

        $with = compact(array_keys(get_defined_vars()));
        $data['content'] = view('admin.staffs.edit')->with($with);

        return $this->main($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StaffRequest $request
     * @param Staff $staff
     * @return RedirectResponse
     * @throws ValidatorException
     */
    public function update(StaffRequest $request, Staff $staff): RedirectResponse
    {
        $input = $request->only($request->getFillableFields('image'));
        //
        $this->saveImage($request, $staff);
        if ($this->repository->update($input, $staff)) {
            $this->setSuccessUpdate();
            $this->fireEvents();
        }

        if ($request->hasFile('images')) {
            $this->saveAdditionalImages($staff, $request);
        }

        if ($request->has('saveClose')) {
            return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
        }

        return redirect()->back()->with($this->getResponseMessage());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Staff $staff
     * @param ImageRemover $imageRemover
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy(Staff $staff, ImageRemover $imageRemover)
    {
        if ($this->repository->delete($staff->getKey())) {
            $imageRemover->removeImage($staff->image);
            foreach ($staff->getImages() as $image) {
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
