<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin\Feedback;

use App\DataContainers\Admin\Feedback\SearchDataContainer;
use App\Enum\FeedbackTypeEnum;
use App\Http\Controllers\Admin\AdminController;
use App\Models\Feedback\Feedback;
use App\Repositories\FeedbackRepository;
use App\Traits\Authorizable;
use Illuminate\Http\Request;

class FeedbackController extends AdminController
{
    use Authorizable;

    private $moduleName;

    protected $key = 'feedback';

    protected $routeKey = 'admin.feedback';

    protected $permissionKey = 'feedback';

    private $repository;

    public function __construct(FeedbackRepository $repository)
    {
        parent::__construct();
        $this->moduleName = __('modules.feedback.title');
        $this->addBreadCrumb($this->moduleName, $this->resourceRoute('index'));
        $this->shareViewModuleData();
        $this->repository = $repository;
    }

    public function index(SearchDataContainer $searchDataContainer, Request $request)
    {
        $searchDataContainer->fillFromRequest($request);
        $types = FeedbackTypeEnum::getEnums();
        $this->setTitle($this->moduleName);
        $list = $this->repository->getListAdmin($searchDataContainer);

        $with = compact(array_keys(get_defined_vars()));
        $data['content'] = view('admin.feedback.index')->with($with);

        return $this->main($data);
    }

    public function destroy(Feedback $feedback)
    {
        if (!$feedback->canDelete()) {
            $this->setFailMessage('Удаление этой записи не доступно');

            return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
        }
        if ($this->repository->delete($feedback->getKey())) {
            if ($feedback->getFiles()) {
                foreach ($feedback->getFiles() as $file) {
                    if (storageFileExists($file)) {
                        storageDisk()->delete($file);
                    }
                }
            }
            $this->setSuccessDestroy();
        }

        return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
    }

}
