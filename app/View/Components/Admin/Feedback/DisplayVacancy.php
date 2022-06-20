<?php declare(strict_types=1);

namespace App\View\Components\Admin\Feedback;

use App\DataContainers\Vacancies\VacancyData;
use App\Enum\ContentTypeEnum;
use App\Models\Feedback\Feedback;
use App\Repositories\ContentRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\View\Component;

class DisplayVacancy extends Component
{
    public $feedback;
    /**
     * @var ContentRepository
     */
    private $contentRepository;

    public function __construct(Feedback $feedback, ContentRepository $contentRepository)
    {
        $this->feedback = $feedback;
        $this->contentRepository = $contentRepository;
    }

    public function render()
    {
        $vacancyId = $this->feedback->getData()['vacancy_id'] ?? null;
        if (!$this->feedback->getTypeEnum()->isVacancy() || !$vacancyId){
            return '';
        }
       try{
           $vacancy = $this->contentRepository->findTyped((int)$vacancyId, ContentTypeEnum::VACANCY);
           $data = VacancyData::createFromContent($vacancy);
       } catch (ModelNotFoundException $e){
           return '<span class="badge badge-warning">Вакансия удалена</span>';
       } catch (\Throwable $e){
            return '';
       }

        return view('components.admin.feedback.display-vacancy')->with(compact('data'));
    }
}
