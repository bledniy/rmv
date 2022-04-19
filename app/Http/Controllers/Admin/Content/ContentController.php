<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin\Content;

use App\Contents\AbstractContentFieldsList;
use App\Contents\ContentFieldsTypeInterface;
use App\Contents\ContentRequestInterface;
use App\Http\Controllers\Admin\AdminController;
use App\Repositories\ContentRepository;
use App\Traits\Controllers\SaveImageTrait;

class ContentController extends AdminController
{
    use SaveImageTrait;

    protected $name = '';

    protected $contentType = '';

    protected $repository;

    private $contentFieldsList;

    public function __construct(
        ContentRepository $repository,
        AbstractContentFieldsList $contentFieldsList
    )
    {
        parent::__construct();
        $this->addBreadCrumb($this->name, $this->resourceRoute('index'));
        $this->shareViewModuleData();
        $this->repository = $repository;
        view()->share('contentFieldsList', $contentFieldsList);
        $this->contentFieldsList = $contentFieldsList;
    }

    public function index()
    {
        $this->setTitle($this->name);
        $list = $this->repository->getListPublicByType($this->contentType);
        $with = compact(array_keys(get_defined_vars()));
        $data['content'] = view('admin.content.index', $with);

        return $this->main($data);
    }

    public function create()
    {
        $data['content'] = view('admin.content.create');

        return $this->main($data);
    }

    public function store(ContentRequestInterface $contentRequest)
    {
        $request = $contentRequest->getRequest();
        $input = $request->only($request->getFillableFields());
        $input['type'] = $this->contentType;
        if ($entity = $this->repository->create($input)) {
            if ($this->contentFieldsList->hasImage()){
                $this->saveImage($request, $entity);
            }
            if ($this->contentFieldsList->hasAdditionalImage()){
                $this->saveImage($request, $entity, ContentFieldsTypeInterface::ADDITIONAL_IMAGE);
            }
            $this->setSuccessStore();
        }

        return $this->redirectOnCreated($entity);
    }

    public function edit($entityId)
    {
        $entity = $this->repository->findTyped($entityId, $this->contentType);
        $vars['edit'] = $entity;
        $title = $this->titleEdit($entity);
        $this->addBreadCrumb($title)->setTitle($title);
        $data['content'] = view('admin.content.edit', $vars);

        return $this->main($data);
    }

    public function update(ContentRequestInterface $contentRequest, $entityId)
    {
        $request = $contentRequest->getRequest();
        $entity = $this->repository->findTyped($entityId, $this->contentType);
        $input = $request->only($request->getFillableFields());
        if ($this->repository->update($input, $entity)) {
            if ($this->contentFieldsList->hasImage()){
                $this->saveImage($request, $entity);
            }
            if ($this->contentFieldsList->hasAdditionalImage()){
                $this->saveImage($request, $entity, ContentFieldsTypeInterface::ADDITIONAL_IMAGE);
            }
            $this->setSuccessUpdate();
        }

        return $this->redirectOnUpdated($entity);
    }

    public function destroy($id)
    {
        $entity = $this->repository->findTyped($id, $this->contentType);
        if ($entity->canDelete() && $this->repository->delete($entity)) {
            $this->setSuccessDestroy();
        }

        return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
    }

}
