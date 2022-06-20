<?php


namespace App\Builders\Validation;


use App\Helpers\Validation\ValidationMaxLengthHelper;

class ValidationRulesBuilder
{
    private $rules = [];

    private $prependKey = '';

    public function name(array $additional = [])
    {
        return $this->addRule('name', $this->merge(['string', 'max:255'], $additional));
    }

    public function title(array $additional = [])
    {
        return $this->addRule('title', $this->merge(['string', 'max:255'], $additional));
    }

    public function requiredName(array $additional = [])
    {
        return $this->addRule('name', $this->merge(['required' => 'required', 'string', 'max:255'], $additional));
    }

    public function image($column = 'image', array $additional = [])
    {
        return $this->addRule($column, $this->merge(['nullable' => 'nullable', 'image'], $additional));
    }

    public function description(array $additional = [])
    {
        return $this->addRule('description',
            $this->merge(['nullable' => 'nullable', 'string', 'max' => 'max:' . ValidationMaxLengthHelper::TEXT], $additional));
    }

    public function except(array $additional = [])
    {
        return $this->nullableText('excerpt', $additional);
    }

    public function nullableText(string $column, array $additional = [])
    {
        return $this->addRule($column,
            $this->merge(['nullable' => 'nullable', 'string' => 'string', 'max' => 'max:' . ValidationMaxLengthHelper::TEXT], $additional));
    }

    public function addRule($key, array $props)
    {
        $this->rules[$key] = $props;

        return $this;
    }

    private function merge(array $main, array $additional)
    {
        return array_unique(array_merge($main, $additional));
    }

    private function getPrependedRules()
    {
        $new = [];
        foreach ($this->rules as $name => $rules) {
            $new[$this->prependKey . $name] = $rules;
        }

        return $new;
    }

    public function build()
    {
        return tap($this->getPrependedRules(), function () {
            $this->rules = [];
        });
    }

    public function withPrependKey($key)
    {
        $this->prependKey = $key;

        return $this;
    }

}