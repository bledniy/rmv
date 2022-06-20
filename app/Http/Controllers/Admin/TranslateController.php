<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Helpers\Debug\LoggerHelper;
use App\Models\Translate\Translate;
use App\Repositories\TranslateRepository;
use App\Traits\Authorizable;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class TranslateController extends AdminController
{
    use Authorizable;

    private $name;

    private $translateRepository;

    public function __construct(TranslateRepository $translateRepository)
    {
        parent::__construct();

        $this->key = $this->routeKey = $this->permissionKey = 'translate';
        $this->name = __('modules.localization.title');
        $this->addBreadCrumb($this->name, $this->resourceRoute('index'));
        $this->shareViewModuleData();
        $this->translateRepository = $translateRepository;
    }

    public function index(Request $request)
    {
        if ($request->has('seed')) {
            return $this->seed();
        }
        $data = [];
        $list = $this->translateRepository->getForAdminDisplay($request);
        $groups = $list->pluck('group')->unique();
        $this->setTitle($this->name);
        // todo clear template - add drop to group with active tab indicator
        $active = $request->session()->get('setting_tab', old('setting_tab', ($groups->first())));
        $with = compact(array_keys(get_defined_vars()));
        $data['content'] = view('admin.translate.index', $with);

        return $this->main($data);
    }

    public function store(Request $request)
    {
        if ($translate = $this->translateRepository->create($request->all())) {
            $this->setSuccessStore();
        }

        return $this->redirectOnCreated($translate);
    }

    public function update(Request $request, $id)
    {
        if ('*' === $id) {
            return $this->bulkUpdate($request);
        }
        $translate = $this->translateRepository->find($id);
        // костыль
        $data = Arr::first(Arr::first($request->all()));
        $this->translateRepository->update($data, $translate);
        $this->setSuccessUpdate();

        return $this->redirectOnUpdated($translate);
    }

    public function bulkUpdate(Request $request)
    {
        if ($request->has('translate')) {
            $ids = array_keys($request->get('translate'));
            $this->setSuccessUpdate();
            $translates = Translate::with('lang')->find($ids);
            $translateRequest = $request->get('translate');
            /** @var  $translates Translate[] */
            foreach ($translates as $translate) {
                try {
                    $data = Arr::get($translateRequest, $translate->getKey());
                    $this->translateRepository->update($data, $translate);
                    //touch for observer works
                    if (!$translate->wasChanged() && $translate->lang->wasChanged()) {
                        $translate->touch();
                    }
                } catch (\Throwable $e) {
                    app(LoggerHelper::class)->error($e);
                }
            }
        }
        $request->flashOnly('setting_tab');

        return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
    }

    private function seed()
    {
        try {
            seedByClass('TranslateTableSeeder');
        } catch (\Throwable $e) {
            $this->setFailMessage($e->getMessage());
        }

        return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
    }

}
