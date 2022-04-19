<?php

namespace App\Events\Admin\Image;

use App\Contracts\HasImagesContract;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class MultipleImageUploaded
{
    use Dispatchable, SerializesModels;

    /**
     * @var HasImagesContract
     */
    private $model;
    /**
     * @var Request
     */
    private $request;
    /**
     * @var Collection
     */
    private $imagesCollection;

    public function __construct(HasImagesContract $model, Collection $imagesCollection, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
        $this->imagesCollection = $imagesCollection;
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    public function getModel(): HasImagesContract
    {
        return $this->model;
    }

    public function getImagesCollection(): Collection
    {
        return $this->imagesCollection;
    }

}
