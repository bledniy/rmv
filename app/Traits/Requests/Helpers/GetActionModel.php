<?php

namespace App\Traits\Requests\Helpers;

use App\Contracts\Requests\RequestParameterModelable;
use Illuminate\Database\Eloquent\Model;

trait GetActionModel
{
    /**
     * @return Model|null
     * @note - using this method requires model binding in your controller
     */
    public function getActionModel(): ?Model
    {
        if (!classImplementsInterface($this, RequestParameterModelable::class)) {
            return null;
        }
        $current_params = \Route::current()->parameters();
        $res = \Arr::get($current_params, $this->getRequestKey());
        if (!is_object($res) or !($res instanceof Model)) {
            $res = null;
        }

        return $res;
    }
}
