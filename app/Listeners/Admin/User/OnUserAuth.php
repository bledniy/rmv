<?php

namespace App\Listeners\Admin\User;

use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;

class OnUserAuth
{

    private $request;

    /**
     * @var $user \App\Models\User
     */
    private $user;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     * @param Login $event
     */
    public function handle(Login $event)
    {
        $this->user = $event->user;
        $this->checkIp();
        $this->addDateAuth();
        $this->user->save();
    }

    private function addDateAuth()
    {
        $this->user->setAttribute('authenticated_at', now());
    }

    private function checkIp()
    {
        $userAgent = $this->request->userAgent();
        $this->user->setAttribute('user_agent', $userAgent);
    }

}
