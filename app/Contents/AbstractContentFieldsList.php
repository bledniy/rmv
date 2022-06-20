<?php declare(strict_types=1);

namespace App\Contents;

use App\Enum\ContentTypeEnum;

abstract class AbstractContentFieldsList
{
    protected $fieldsList;

    protected $contentTypeEnum;

    protected $titles = [];

    public function __construct(array $fieldsList = [])
    {
        $this->fieldsList = $fieldsList;
        $this->contentTypeEnum = ContentTypeEnum::create(ContentTypeEnum::DEFAULT);
        $this->loadDefaultTitles();
    }

    private function loadDefaultTitles(): void
    {
        $titles = [
            ContentFieldsTypeInterface::NAME => __('form.title'),
            ContentFieldsTypeInterface::TITLE => __('form.title'),
            ContentFieldsTypeInterface::EXCERPT => __('form.excerpt'),
            ContentFieldsTypeInterface::DESCRIPTION => __('form.description'),
            ContentFieldsTypeInterface::URL => __('form.url'),
            ContentFieldsTypeInterface::IMAGE => __('form.image.image'),
            ContentFieldsTypeInterface::ADDITIONAL_IMAGE => __('form.image.additional'),
            ContentFieldsTypeInterface::SORT => __('form.sorting'),
            ContentFieldsTypeInterface::ACTIVE => __('form.active'),
        ];
        foreach ($titles as $key => $title) {
            $this->titles[$key] = $title;
        }
    }

    public function getInputTitle(string $fieldName)
    {
        if (array_key_exists($fieldName, $this->titles)) {
            return $this->titles[$fieldName];
        }
        throw new \InvalidArgumentException(sprintf('Invalid field name %s', $fieldName));
    }

    public function getFieldsList(): array
    {
        return $this->fieldsList;
    }

    public function hasField(string $field): bool
    {
        return in_array($field, $this->getFieldsList(), true);
    }

    public function hasImage(): bool
    {
        return $this->hasField(ContentFieldsTypeInterface::IMAGE);
    }

    public function hasAdditionalImage(): bool
    {
        return $this->hasField(ContentFieldsTypeInterface::ADDITIONAL_IMAGE);
    }

    public function hasDescription(): bool
    {
        return $this->hasField(ContentFieldsTypeInterface::DESCRIPTION);
    }

    public function hasExcerpt(): bool
    {
        return $this->hasField(ContentFieldsTypeInterface::EXCERPT);
    }

    public function hasName(): bool
    {
        return $this->hasField(ContentFieldsTypeInterface::NAME);
    }

    public function hasTitle(): bool
    {
        return $this->hasField(ContentFieldsTypeInterface::TITLE);
    }

    public function hasActive(): bool
    {
        return $this->hasField(ContentFieldsTypeInterface::ACTIVE);
    }

    public function hasUrl(): bool
    {
        return $this->hasField(ContentFieldsTypeInterface::URL);
    }

    public function hasSort(): bool
    {
        return $this->hasField(ContentFieldsTypeInterface::SORT);
    }

    public function getContentTypeEnum(): ContentTypeEnum
    {
        return $this->contentTypeEnum;
    }


//    TITLES
    public function getTitleName(): string
    {
        return $this->getInputTitle(ContentFieldsTypeInterface::NAME);
    }

    public function getTitleTitle(): string
    {
        return $this->getInputTitle(ContentFieldsTypeInterface::TITLE);
    }

    public function getTitleExcerpt(): string
    {
        return $this->getInputTitle(ContentFieldsTypeInterface::EXCERPT);
    }

    public function getTitleDescription(): string
    {
        return $this->getInputTitle(ContentFieldsTypeInterface::DESCRIPTION);
    }

    public function getTitleActive(): string
    {
        return $this->getInputTitle(ContentFieldsTypeInterface::ACTIVE);
    }

    public function getTitleImage(): string
    {
        return $this->getInputTitle(ContentFieldsTypeInterface::IMAGE);
    }

    public function getTitleAdditionalImage(): string
    {
        return $this->getInputTitle(ContentFieldsTypeInterface::ADDITIONAL_IMAGE);
    }

    public function getTitleSort(): string
    {
        return $this->getInputTitle(ContentFieldsTypeInterface::SORT);
    }

    public function getTitleUrl(): string
    {
        return $this->getInputTitle(ContentFieldsTypeInterface::URL);
    }

}