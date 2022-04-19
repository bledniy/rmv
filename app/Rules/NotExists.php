<?php

namespace App\Rules;

class NotExists extends AbstractRule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value, $parameters = []): bool
    {
        return \DB::table($parameters[0])
                ->where($parameters[1], '=', $value)
                ->count() < 1;
    }

}
