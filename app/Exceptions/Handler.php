<?php declare(strict_types=1);

namespace App\Exceptions;

use App\Mail\ExceptionOccurred;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{

    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];


    public function report(Throwable $e): void
    {
        parent::report($e);

        if ($this->shouldReport($e)) {
            $this->sendEmail($e); // sends an email
        }
    }

    protected function sendEmail(Throwable $e): void
    {
        //todo add exception notifier from another project
        try {
            $html = $this->renderExceptionWithSymfony($e, true);
            if (env('DEBUG_EMAIL') && !isLocalEnv()) {
                $excSha = sha1($html);
                $cacheKey = 'exception.' . $excSha;
                if (!\Cache::has($cacheKey)) {
                    \Mail::queue(new ExceptionOccurred($html));
                    \Cache::set($cacheKey, true);
                }
            }
        } catch (\Throwable $ex) {
        }
    }
}
