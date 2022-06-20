<?php declare(strict_types=1);

namespace App\Uploaders\Feedback;

use App\Uploaders\BaseFileUploader;

class FeedbackFilesUploader extends BaseFileUploader
{
	protected $path = 'feedback/uploads';
}