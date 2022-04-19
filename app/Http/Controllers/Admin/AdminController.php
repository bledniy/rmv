<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Contracts\HasImagesContract;
use App\Events\Admin\Image\MultipleImageUploaded;
use App\Http\Controllers\BaseController;
use App\Models\Admin\Photo;
use App\Models\Model;
use App\Repositories\Admin\AdminMenuRepository;
use App\Traits\Controllers\ResourceControllerHelpers;
use App\Traits\Controllers\ResourceControllerPreActions;
use App\Traits\Controllers\ResourceControllerReturnMessages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

abstract class AdminController extends BaseController
{
    use ResourceControllerReturnMessages;
    use ResourceControllerHelpers;
    use ResourceControllerPreActions;

    /**
     * @var string
     * For module route prefix
     */
    protected $routeKey;

    /**
     * @var string
     * For check permissions in Authorizable trait, and to share to views key for check permissions
     */
    protected $permissionKey;

    /**
     * @var string
     * "Module" key, for methods like getThumbnailSizes()
     */
    protected $key;

    public function __construct()
    {
        parent::__construct();
        $this->addBreadCrumb(__('generic.dashboard'), route('admin.index'));
    }

    public function main($data)
    {
        $data['cardTitle'] = $data['cardTitle'] ?? $this->getTitle();
        $this->setTitle(' - ' . getSetting('global.sitename'));
        $data['menu'] = app(AdminMenuRepository::class)->getNestedMenu();
        $data['breadcrumbs'] = $this->getBreadCrumbs();

        return view('admin.layouts.app-admin', $data);
    }

    protected function saveAdditionalImages(HasImagesContract $belongToModel, Request $request): void
    {
        $imagesCollection = app(Photo::class)->saveAdditionPhotos($belongToModel, $request);
        event(new MultipleImageUploaded($belongToModel, $imagesCollection, $request));
    }

    public function callAction($method, $parameters)
    {
        switch ($method) {
            case 'index' :
                $this->beforeIndex($parameters);
                break;
            case 'create' :
                $this->beforeCreate($parameters);
                break;
            case 'store' :
                $this->beforeStore($parameters);
                break;
            case 'edit' :
                $this->beforeEdit($parameters);
                break;
            case 'update' :
                $this->beforeUpdate($parameters);
                break;
            case 'show' :
                $this->beforeShow($parameters);
                break;
            case 'destroy' :
                $this->beforeDestroy($parameters);
                break;
        }
        $this->beforeCallAction($method, $parameters);

        return parent::callAction($method, $parameters);
    }

    protected function shareViewModuleData(): void
    {
        View::share('routeKey', ($this->routeKey ?? $this->key ?? null));
        View::share('permissionKey', ($this->permissionKey ?? null));
        View::share('key', ($this->key ?? null));
    }

    protected function beforeCallAction($method, $parameters): void { }

    protected function redirectOnCreated(\Illuminate\Database\Eloquent\Model $model)
    {
        if (app('request')->has('createOpen')) {
            return redirect($this->resourceRoute('edit', $model->getKey()))->with($this->getResponseMessage());
        }

        return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
    }

    protected function redirectOnUpdated(Model $model)
    {
        if (app('request')->expectsJson()) {
            return $this->getResponseMessageForJson();
        }
        if (app('request')->has('saveClose')) {
            return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
        }

        return redirect($this->resourceRoute('edit', $model->getKey()))->with($this->getResponseMessage());
    }

}
