<?php

namespace App\ContentTypes;
class KeyValue extends BaseType
{
    /**
     * Handle password fields.
     *
     * @return string
     */
    public function handle()
    {
        $values = $this->request->input($this->row->field, []);
        $values = remakeKeyValue($values);

        return json_encode($values);
    }
}
