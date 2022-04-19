<?php declare(strict_types=1);

namespace App\Builders\Seeder;

use App\Models\Translate\Translate;

final class TranslateBuilder
{
    private $key = '';

    private $value = '';

    private $type = 'text';

    private $displayName = '';

    private $group = '';

    private $variables = [];

    public function setKey(string $key): self
    {
        $this->key = $key;
        $this->setGroup($this->extractGroupFromTranslateKey($key));

        return $this;
    }

    private function extractGroupFromTranslateKey(string $translateKey): string
    {
        $parts = explode('.', $translateKey);

        return $parts[0] ?? '';
    }

    public function setTypeText(): self
    {
        $this->type = Translate::TYPE_TEXT;

        return $this;
    }

    public function setTypeTextarea(): self
    {
        $this->type = Translate::TYPE_TEXTAREA;

        return $this;
    }

    public function setTypeEditor(): self
    {
        $this->type = Translate::TYPE_EDITOR;

        return $this;
    }

    public function setValue(?string $value = null): self
    {
        $this->value = $value;

        return $this;
    }

    public function setDisplayName(string $displayName): self
    {
        $this->displayName = $displayName;

        return $this;
    }

    public function setVariables(array $variables): self
    {
        $this->variables = $variables;

        return $this;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getDisplayName(): string
    {
        return $this->displayName;
    }

    public function getVariables(): array
    {
        return $this->variables;
    }

    public function getGroup(): string
    {
        return $this->group;
    }

    public function setGroup(string $group): self
    {
        $this->group = $group;

        return $this;
    }

    public function build(): array
    {
        return [
            'key' => $this->key,
            'value' => $this->value,
            'type' => $this->type,
            'display_name' => $this->displayName,
            'variables' => $this->variables,
            'group' => $this->group,
        ];
    }

}