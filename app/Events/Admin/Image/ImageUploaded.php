<?php

namespace App\Events\Admin\Image;

use App\Models\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;

class ImageUploaded
{
    use Dispatchable, SerializesModels;

    /**
     * @var Model
     */
    private $model;
    /**
     * @var Request
     */
    private $request;

    public function __construct(Model $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    public function getModel(): Model
    {
        return $this->model;
    }
}
