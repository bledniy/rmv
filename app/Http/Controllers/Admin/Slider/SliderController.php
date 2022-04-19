<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin\Slider;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\Slider\SliderRequest;
use App\Models\Admin\Photo;
use App\Models\Slider\Slider;
use App\Repositories\SliderRepository;
use App\Traits\Authorizable;
use App\Traits\Controllers\SaveImageTrait;
use App\Traits\Models\ImageAttributeTrait;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class SliderController extends AdminController
{
    use Authorizable;

    use SaveImageTrait;

    use ImageAttributeTrait;

    protected $name = 'Слайдеры';

    protected $key = 'sliders';

    protected $permissionKey = 'sliders';

    protected $routeKey = 'admin.sliders';
    /**
     * @var SliderRepository
     */
    private $sliderRepository;

    public function __construct(SliderRepository $sliderRepository)
    {
        parent::__construct();
        $this->sliderRepository = $sliderRepository;
        $this->addBreadCrumb($this->name, $this->resourceRoute('index'));
        $this->shareViewModuleData();
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        $title = $this->name;
        $this->setTitle($title);
        $list = $this->sliderRepository->getListForAdmin();
        $data['content'] = view('admin.sliders.index', compact('list'));

        return $this->main($data);
    }

    /**
     * @param Slider $slider
     * @return Factory|View
     */
    public function create(Slider $slider)
    {
        $data['content'] = view('admin.sliders.create')->with(['edit' => $slider,]);

        return $this->main($data);
    }

    /**
     * @param SliderRequest $request
     * @param Slider $slider
     * @return RedirectResponse|Redirector
     */
    public function store(SliderRequest $request, Slider $slider)
    {
        if ($this->sliderRepository->save($request, $slider)) {
            $this->setSuccessStore();
        }
        if ($request->has('createOpen')) {
            return redirect($this->resourceRoute('edit', $slider->id))->with($this->getResponseMessage());
        }

        return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
    }

    /**
     * @param $id
     * @return Application|Factory|RedirectResponse|Redirector|View
     */
    public function edit($id)
    {
        $vars['edit'] = $slider = $this->sliderRepository->findForEdit((int)$id);
        if (!$slider) {
            $this->setMessage(__('modules._.record-not-finded'));

            return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
        }
        $this->setTitle($title = 'Редактирование #' . $slider->getKey())->addBreadCrumb($title);

        $data['content'] = view('admin.sliders.edit', $vars);

        return $this->main($data);
    }

    /**
     * @param SliderRequest $request
     * @param Slider $slider
     * @return RedirectResponse|Redirector
     */
    public function update(SliderRequest $request, Slider $slider)
    {
        if ($this->sliderRepository->save($request, $slider)) {
            $this->setSuccessUpdate();
        }

        if ($request->has('saveClose')) {
            return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
        }

        return redirect()->back()->with($this->getResponseMessage());
    }

    /**
     * @param Slider $slider
     * @param Photo $photo
     * @return RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy(Slider $slider, Photo $photo)
    {
        if ($slider->canDelete() && $slider->delete()) {
            $photo->deleteImageStorage($slider->getImage());
            $this->setSuccessDestroy();
            $this->fireEvents();
        }
        $this->setFailMessage('Удаление не доступно');

        return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
    }


    private function fireEvents()
    {
    }

    public function createSliderItem(Request $request, Slider $slider, SliderRepository $sliderRepository)
    {
        $this->authorize('add_sliders');
        $this->setFailStore();
        if ($sliderRepository->storeSlideItem($request, $slider)) {
            $this->setSuccessStore();
        }

        return $this->getResponseMessageForJson();

    }
}
