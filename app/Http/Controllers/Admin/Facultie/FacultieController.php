<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin\Facultie;

use App\Helpers\Media\ImageRemover;
use App\Http\Controllers\Admin\AdminController;
use App\Models\Facultie\Facultie;
use App\Repositories\FacultieRepository;
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

class FacultieController extends AdminController
{
    use Authorizable;
    use SaveImageTrait;

    public $thumbnailWidth = false;
    public $thumbnailHeight = false;

    private $name;

    protected $key = 'facultie';

    protected $routeKey = 'admin.faculties';

    protected $permissionKey = 'faculties';
    /**
     * @var FacultieRepository
     */
    private $repository;

    public function __construct(FacultieRepository $repository)
    {
        parent::__construct();
        $this->name = __('modules.facultie.title');
        $this->addBreadCrumb($this->name, $this->resourceRoute('index'));
        $this->shareViewModuleData();
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(FacultieRepository $facultieRepository)
    {
        $this->setTitle($this->name);
        $vars['list'] = $facultieRepository->getListForAdmin();
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
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     * @throws ValidatorException
     */
    public function store(Request $request)
    {
        $input = $request->only($request->getFillableFields('image'));
        if ($facultie = $this->repository->create($input)) {
            $this->setSuccessStore();
            $this->saveImage($request, $facultie);
            $this->fireEvents();
        }
        if ($request->has('createOpen')) {
            return redirect($this->resourceRoute('edit', $facultie->getKey()))->with($this->getResponseMessage());
        }

        return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Facultie $facultie
     * @return Application|Factory|View|Response
     */
    public function edit(Facultie $facultie)
    {
        $edit = $this->repository->findForEdit($facultie->getKey());
        $this->addBreadCrumb($this->titleEdit($edit))->setTitle($this->titleEdit($edit));

        $with = compact(array_keys(get_defined_vars()));
        $data['content'] = view('admin.faculties.edit')->with($with);

        return $this->main($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Facultie $facultie
     * @return RedirectResponse
     */
    public function update(Request $request, Facultie $facultie): RedirectResponse
    {
        $input = $request->only($request->getFillableFields('image'));
        //
        $this->saveImage($request, $facultie);
        if ($this->repository->update($input, $facultie)) {
            $this->setSuccessUpdate();
            $this->fireEvents();
        }

        if ($request->hasFile('images')) {
            $this->saveAdditionalImages($facultie, $request);
        }

        if ($request->has('saveClose')) {
            return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
        }

        return redirect()->back()->with($this->getResponseMessage());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Facultie $facultie
     * @param ImageRemover $imageRemover
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy(Facultie $facultie, ImageRemover $imageRemover)
    {
        if ($this->repository->delete($facultie->getKey())) {
            $imageRemover->removeImage($facultie->image);
            foreach ($facultie->getImages() as $image) {
                $imageRemover->removeImage($image->image);
            }
            $this->setSuccessDestroy();
            $this->fireEvents();
        }

        return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
    }
}
