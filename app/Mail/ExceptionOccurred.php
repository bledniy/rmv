<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExceptionOccurred extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The body of the message.
     *
     * @var string
     */
    public $content;

    /**
     * ExceptionOccurred constructor.
     * @param $content
     */

    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        try {
            $user = \Auth::guard('admin')->user();
            $build = $this->to(env('DEBUG_EMAIL'))
                ->view('mail.exception')
                ->with('content', $this->content)
                ->with('user', $user)
            ;

            return $build;
        } catch (\Exception $e) {
            return $this;
        }
    }

}
