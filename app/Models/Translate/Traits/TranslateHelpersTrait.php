<?php

namespace App\Models\Translate\Traits;

trait TranslateHelpersTrait
{

    public function isTypeTextarea(): bool
    {
        return $this->type === static::TYPE_TEXTAREA;
    }

    public function isTypeText(): bool
    {
        return $this->type === static::TYPE_TEXT;
    }

    public function isTypeEditor(): bool
    {
        return $this->type === static::TYPE_EDITOR;
    }

    public function getAppendClickBoardText(): string
    {
        return $this->isFormatable() ? $this->getAppendArguments() : sprintf("', '%s')", $this->getValue());
    }

    public function isFormatable(): bool
    {
        if (!is_string($this->value)) {
            return false;
        }
        /** @var  $contains  bool */
        $contains = \Str::contains($this->value, ['%']);

        return $contains;
    }

    protected function getAppendArguments(): string
    {
        $str = '';
        $needle = $this->getAppendNeedle();
        $vars = $this->getVarsFromValue($this->lang->value);
        if ($vars) {
            $str = "', [";
            foreach ($vars as $var) {
                $str .= sprintf("'%s%s%s' => $%s, ", $needle, $var, $needle, $var);
            }
            $str .= '])';
        }

        return $str;
    }

    protected function getAppendNeedle(): string
    {
        return '%';
    }

    protected function getVarsFromValue(string $value): array
    {
        try {
            $needle = $this->getAppendNeedle();
            preg_match_all('/(\\' . $needle . '[a-zА-Я]+' . $needle . ')/i', $value, $matches);
            $vars = array_map(static function ($variable) use ($needle) {
                return str_replace($needle, '', $variable);
            }, $matches[0]);
        } catch (\Exception $e) {
            $vars = [];
        }

        return $vars;
    }

    public function getPrependClickBoardText(): string
    {
        return $this->isFormatable() ? "translateFormat('" : "getTranslate('";
    }

}