<?php declare(strict_types=1);

namespace App\Contents;

use App\Enum\ContentTypeEnum;

final class ContentFieldsList extends AbstractContentFieldsList
{
    public function setFieldsList(array $fieldsList): self
    {
        $this->fieldsList = $fieldsList;

        return $this;
    }

    public function addField(string $field): self
    {
        $this->fieldsList[] = $field;

        return $this;
    }

    public function setContentTypeEnum(ContentTypeEnum $contentTypeEnum): self
    {
        $this->contentTypeEnum = $contentTypeEnum;

        return $this;
    }

    /**
     * @param array<string> $titles
     */
    public function setTitles(array $titles): self
    {
        $this->titles = $titles;

        return $this;
    }

    public function addTitle(string $key, string $value): self
    {
        $this->titles[$key] = $value;

        return $this;
    }

}