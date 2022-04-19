<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enum\FeedbackTypeEnum;
use App\Events\Feedback\FeedbackCreated;
use App\Http\Requests\AbstractRequest as Request;
use App\Http\Requests\Feedback\DefaultFeedbackRequest;
use App\Http\Requests\Feedback\VacancyFeedbackRequest;
use App\Models\Feedback\Feedback;
use App\Repositories\FeedbackRepository;
use App\Uploaders\Feedback\FeedbackFilesUploader;

class FeedbackController extends SiteController
{
	private $repository;

	public function __construct(FeedbackRepository $repository)
	{
		parent::__construct();
		$this->repository = $repository;
	}

	public function vacancy(VacancyFeedbackRequest $request)
	{
		$request->merge(['type' => new FeedbackTypeEnum(FeedbackTypeEnum::VACANCY)]);

		return $this->feedback($request);
	}

	public function default(DefaultFeedbackRequest $request)
	{
		$request->merge(['type' => new FeedbackTypeEnum(FeedbackTypeEnum::DEFAULT)]);

		return $this->feedback($request);
	}

	protected function feedback(Request $request)
	{
		$this->setFailMessage(getTranslate('feedback.send-failed'));
		$input = $request->only($request->getFillableFields());
		$this->setResponseData(['successFeedback' => (string)$request->get('type')]);

		/** @var  $feedback Feedback */
		if ($feedback = $this->repository->create($input)) {
			if ($request->hasFile('files')) {
				$uploader = app(FeedbackFilesUploader::class)->appendToPath($feedback->getKey());
				foreach ($request->file('files') as $file) {
					$paths[$file->getClientOriginalName()] = $uploader->upload($file);
				}
				$feedback->setFiles($paths ?? []);
				$this->repository->update([], $feedback);
			}
			event(app(FeedbackCreated::class, compact('feedback')));
			$this->setSuccessMessage(getTranslate('feedback.send-success', 'Заявка успешно отправлена'));
		}
		if ($request->ajax()){
            return $this->getResponseMessageForJson();
        }

		return redirect()->back()->with($this->getResponseMessage());
    }
}
