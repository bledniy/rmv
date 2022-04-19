<?php declare(strict_types=1);

namespace App\Contents;

interface ContentFieldsDataInterface
{
    public function getFields(): AbstractContentFieldsList;

    public function hasCustomValidationRules(string $field): bool;

    public function getCustomValidationRules(string $field): array;

    public function getAdditionalCustomValidationRules(): array;
}