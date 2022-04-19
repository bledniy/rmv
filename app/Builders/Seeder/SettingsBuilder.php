<?php declare(strict_types=1);

namespace App\Builders\Seeder;

use Illuminate\Support\Str;

class SettingsBuilder
{
    private $key = '';

    private $value = '';

    private $type = 'text';

    private $displayName = '';

    public function setKey(string $_): self
    {
        $this->key = $_;

        return $this;
    }

    public function setType(string $_): self
    {
        $this->type = $_;

        return $this;
    }

    public function setTypeTextarea(): self
    {
        $this->type = 'rich_text_box';

        return $this;
    }

    public function setTypeEditor(): self
    {
        $this->type = 'ckeditor';

        return $this;
    }

    public function setTypeFile(): self
    {
        $this->type = 'file';

        return $this;
    }

    public function setTypeCheckbox(): self
    {
        $this->setType('checkbox');

        return $this;
    }

    public function setValue(?string $_ = null): self
    {
        $this->value = $_;

        return $this;
    }

    public function setDisplayName(string $_): self
    {
        $this->displayName = $_;

        return $this;
    }

    public function build()
    {
        return [
            'key' => $this->key,
            'value' => $this->value,
            'type' => $this->type,
            'display_name' => $this->displayName,
        ];
    }

    public function offsetExists($offset)
    {
        return property_exists($this, $offset);
    }

    public function offsetGet($offset)
    {
        return $this->offsetExists($offset) ? $this->{$offset} : null;
    }

    public function offsetSet($offset, $value)
    {
        $method = Str::camel('set' . ucfirst($offset));
        if (method_exists($this, $method)) {
            $this->$method($value);
        }
    }

    public function offsetUnset($offset)
    {
        if ($this->offsetExists($offset)) {
            $this->{$offset} = null;
        }
    }

}