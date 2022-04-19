<?php

namespace App\Http\Controllers\Admin\Staff;

class LogViewController extends \Rap2hpoutre\LaravelLogViewer\LogViewerController
{
    public function index()
    {
        \Gate::authorize('view_logs');

        return parent::index();
    }
}
