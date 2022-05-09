<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin\Faculty;

use App\Helpers\Media\ImageRemover;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\FacultieRequest;
use App\Models\Faculty\Faculty;
use App\Repositories\FacultyRepository;
use App\Traits\Authorizable;
use App\Traits\Controllers\SaveImageTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Prettus\Validator\Exceptions\ValidatorException;

class FacultyController extends AdminController
{
    use Authorizable;
    use SaveImageTrait;

    public $thumbnailWidth = false;
    public $thumbnailHeight = false;

    private $name;

    protected $key = 'faculty';

    protected $routeKey = 'admin.faculties';

    protected $permissionKey = 'faculty';
    /**
     * @var FacultyRepository
     */
    private $repository;

    public function __construct(FacultyRepository $repository)
    {
        parent::__construct();
        $this->name = __('modules.faculty.title');
        $this->addBreadCrumb($this->name, $this->resourceRoute('index'));
        $this->shareViewModuleData();
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(FacultyRepository $facultyRepository)
    {
        $this->setTitle($this->name);
        $vars['list'] = $facultyRepository->getListForAdmin();
        $data['content'] = view('admin.faculties.index', $vars);

        return $this->main($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $data['content'] = view('admin.faculties.create');

        return $this->main($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FacultieRequest $request
     * @return Application|RedirectResponse|Redirector
     * @throws ValidatorException
     */
    public function store(FacultieRequest $request)
    {
        $input = $request->only($request->getFillableFields('image'));
        if ($faculty = $this->repository->create($input)) {
            $this->setSuccessStore();
            $this->saveImage($request, $faculty);
            $this->fireEvents();
        }
        if ($request->has('createOpen')) {
            return redirect($this->resourceRoute('edit', $faculty->getKey()))->with($this->getResponseMessage());
        }

        return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Faculty $faculty
     * @return Application|Factory|View
     */
    public function edit(Faculty $faculty)
    {
        $edit = $this->repository->findForEdit($faculty->getKey());
        $this->addBreadCrumb($this->titleEdit($edit))->setTitle($this->titleEdit($edit));

        $with = compact(array_keys(get_defined_vars()));
        $data['content'] = view('admin.faculties.edit')->with($with);

        return $this->main($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FacultieRequest $request
     * @param Faculty $faculty
     * @return RedirectResponse
     * @throws ValidatorException
     */
    public function update(FacultieRequest $request, Faculty $faculty): RedirectResponse
    {
        $input = $request->only($request->getFillableFields('image'));
        //
        $this->saveImage($request, $faculty);
        if ($this->repository->update($input, $faculty)) {
            $this->setSuccessUpdate();
            $this->fireEvents();
        }

        if ($request->hasFile('images')) {
            $this->saveAdditionalImages($faculty, $request);
        }

        if ($request->has('saveClose')) {
            return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
        }

        return redirect()->back()->with($this->getResponseMessage());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Faculty $faculty
     * @param ImageRemover $imageRemover
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy(Faculty $faculty, ImageRemover $imageRemover)
    {
        if ($this->repository->delete($faculty->getKey())) {
            $imageRemover->removeImage($faculty->image);
            foreach ($faculty->getImages() as $image) {
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
