<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

abstract class AbstractRule implements Rule
{

    private $message = [];

    /**
     * AbstractRule constructor.
     */
    public function __construct()
    {

    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    abstract public function passes($attribute, $value): bool;

    /**
     * @param string $message
     * @return $this
     */
    protected function setMessage(string $message): self
    {
        $this->message[] = $message;

        return $this;
    }

    /**
     * @return array|string
     */
    public function message()
    {
        return $this->message;
    }
}
