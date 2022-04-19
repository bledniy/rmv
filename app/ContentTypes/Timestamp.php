<?php

namespace App\ContentTypes;


use Illuminate\Support\Carbon;

class Timestamp extends BaseType
{
    public function handle(): ?Carbon
    {
        if (!in_array($this->request->method(), ['PUT', 'POST'])) {
            return null;
        }

        $content = $this->request->input($this->row->field);

        if (empty($content)) {
            return null;
        }

        return Carbon::parse($content);
    }
}
