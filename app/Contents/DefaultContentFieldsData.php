<?php declare(strict_types=1);

namespace App\Contents;

final class DefaultContentFieldsData implements ContentFieldsDataInterface
{
    private $fields;

    private $customValidationRules = [];

    private $additionalCustomValidationRules = [];


    public function __construct(AbstractContentFieldsList $fields)
    {
        $this->fields = $fields;
    }

    public function getFields(): AbstractContentFieldsList
    {
        return $this->fields;
    }

    public function hasCustomValidationRules(string $field): bool
    {
        return count($this->customValidationRules) > 0;
    }

    public function getCustomValidationRules(string $field): array
    {
        return $this->customValidationRules;
    }

    public function getAdditionalCustomValidationRules(): array
    {
        return $this->additionalCustomValidationRules;
    }

    public function setFields(AbstractContentFieldsList $fields): self
    {
        $this->fields = $fields;

        return $this;
    }

    public function setCustomValidationRules(array $customValidationRules): self
    {
        $this->customValidationRules = $customValidationRules;

        return $this;
    }

    public function setAdditionalCustomValidationRules(array $additionalCustomValidationRules): self
    {
        $this->additionalCustomValidationRules = $additionalCustomValidationRules;

        return $this;
    }

}