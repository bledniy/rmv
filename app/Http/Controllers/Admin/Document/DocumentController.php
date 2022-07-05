<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin\Document;

use App\Helpers\Media\ImageRemover;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\DocumentRequest;
use App\Models\Document\Document;
use App\Repositories\DocumentRepository;
use App\Traits\Authorizable;
use App\Traits\Controllers\SaveImageTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Prettus\Validator\Exceptions\ValidatorException;

class DocumentController extends AdminController
{
    use Authorizable;
    use SaveImageTrait;

    public $thumbnailWidth = false;
    public $thumbnailHeight = false;

    private $name;

    protected $key = 'document';

    protected $routeKey = 'admin.documents';

    protected $permissionKey = 'documents';
    /**
     * @var DocumentRepository
     */
    private $repository;

    public function __construct(DocumentRepository $repository)
    {
        parent::__construct();
        $this->name = __('modules.documents.title');
        $this->addBreadCrumb($this->name, $this->resourceRoute('index'));
        $this->shareViewModuleData();
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(DocumentRepository $documentRepository)
    {
        $this->setTitle($this->name);
        $vars['list'] = $documentRepository->getListForAdmin();
        $data['content'] = view('admin.documents.index', $vars);

        return $this->main($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $data['content'] = view('admin.documents.create');

        return $this->main($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DocumentRequest $request
     * @return Application|RedirectResponse|Redirector
     * @throws ValidatorException
     */
    public function store(DocumentRequest $request)
    {
        $input = $request->only($request->getFillableFields('file'));
        if ($document = $this->repository->create($input)) {
            $this->setSuccessStore();
            if (!empty($request->file)){
                $fileName = time().'.'.$request->file->extension();
                $request->file->move(public_path('storage/docs'), $fileName);
                $document->file = $fileName;
            }
            $this->fireEvents();
        }
        if ($request->has('createOpen')) {
            return redirect($this->resourceRoute('edit', $document->getKey()))->with($this->getResponseMessage());
        }

        return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Document $document
     * @return Application|Factory|View
     */
    public function edit(Document $document)
    {
        $edit = $this->repository->findForEdit($document->getKey());
        $this->addBreadCrumb($this->titleEdit($edit))->setTitle($this->titleEdit($edit));
        $with = compact(array_keys(get_defined_vars()));
        $data['content'] = view('admin.documents.edit')->with($with);

        return $this->main($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DocumentRequest $request
     * @param Document $document
     * @return RedirectResponse
     * @throws ValidatorException
     */
    public function update(DocumentRequest $request, Document $document): RedirectResponse
    {
        $input = $request->only($request->getFillableFields('file'));
        //
        if ($this->repository->update($input, $document)) {
            if (!empty($request->file)){
                $fileName = time().'.'.$request->file->extension();
                $request->file->move(public_path('storage/docs'), $fileName);
                $this->repository->update(['file' => $fileName], $document);
            }
            $this->setSuccessUpdate();
            $this->fireEvents();
        }
        if ($request->has('saveClose')) {
            return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
        }

        return redirect()->back()->with($this->getResponseMessage());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Document $document
     * @param ImageRemover $imageRemover
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy(Document $document, ImageRemover $imageRemover)
    {
        if ($this->repository->delete($document->getKey())) {
            $imageRemover->removeImage($document->image);
            foreach ($document->getImages() as $image) {
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
