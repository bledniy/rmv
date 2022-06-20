<?php

namespace App\Traits\Migrations;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\ColumnDefinition;

trait MigrationCreateFieldTypes
{
    /**
     * @var Blueprint
     */
    protected $tableBlueprint;

    public function setTable(Blueprint $table): self
    {
        $this->tableBlueprint = $table;

        return $this;
    }

    public function createActive(): self
    {
        $this->table()->boolean('active')->default(true);

        return $this;
    }

    public function createActiveIndexed(): self
    {
        $this->table()->boolean('active')->default(true)->index();

        return $this;
    }

    public function createDefault($column = 'default', $default = false): self
    {
        $this->table()->integer($column)->default($default);

        return $this;
    }

    public function createBoolean(string $field, $default = true): self
    {
        $this->table()->boolean($field)->default($default);

        return $this;
    }

    public function createImage($field = 'image'): self
    {
        $this->createNullableString($field, 255);

        return $this;
    }

    public function createFile($field = 'file'): self
    {
        $this->createNullableString($field, 255);

        return $this;
    }

    public function nullableDateTime($field = 'date'): self
    {
        $this->table()->dateTime($field)->nullable();

        return $this;
    }

    public function createType($field = 'type', ?string $default = null): self
    {
        $table = $this->table()->string($field, 255)->nullable();
        if (null === $default) {
            return $this;
        }
        $table->default($default);

        return $this;
    }

    public function createNullableChar(string $column, int $length = 255): self
    {
        $this->table()->char($column, $length)->nullable();

        return $this;
    }

    public function createName(): self
    {
        $this->createNullableString('name', 255);

        return $this;
    }

    public function createTitle($length = 255): self
    {
        $this->createNullableString('title', $length);

        return $this;
    }

    public function createPrice(): self
    {
        $this->createFloatPrice();

        return $this;
    }

    public function createFloatPrice(): self
    {
        return $this->createFloat('price');
    }

    public function createFloat(string $column): self
    {
        $this->table()->float($column)->default(0);

        return $this;
    }

    public function createTotal(): self
    {
        $this->table()->float('total')->default(0);

        return $this;
    }

    public function createAmount(): self
    {
        $this->table()->unsignedInteger('amount')->default(1);

        return $this;
    }

    public function createQuantity(): self
    {
        $this->table()->unsignedInteger('quantity')->default(1);

        return $this;
    }

    public function createIntPrice(): self
    {
        $this->unsignedInt('price');

        return $this;
    }

    public function unsignedInt(string $field, $default = 0): self
    {
        $this->table()->unsignedInteger($field)->default($default);

        return $this;
    }

    public function unsignedBigInt(string $field, $default = 0): self
    {
        $this->table()->unsignedBigInteger($field)->default($default);

        return $this;
    }

    public function createDescription(): self
    {
        $this->createNullableText('description');

        return $this;
    }

    public function createExcerpt(): self
    {
        $this->createNullableText('excerpt');

        return $this;
    }

    public function createMediumDescription(): self
    {
        $this->table()->mediumText('description')->nullable();

        return $this;
    }

    public function createLongDescription(): self
    {
        $this->table()->longText('description')->nullable();

        return $this;
    }

    public function createUrl($unique = false, $field = 'url'): self
    {
        $column = $this->table()->string($field, 160)->nullable();
        if ($unique) {
            $column->unique();
        }

        return $this;
    }

    public function smallInt(string $field, $default = 0): self
    {
        $this->table()->smallInteger($field)->default($default);

        return $this;
    }

    public function createUniqueUrl(): self
    {
        $this->createUrl(true);

        return $this;
    }

    public function createSort(): self
    {
        $this->table()->smallInteger('sort')->nullable()->default(0);

        return $this;
    }

    public function createVideo(): self
    {
        $this->table()->text('video')->nullable();

        return $this;
    }

    public function createWeight(): self
    {
        $this->table()->float('weight')->nullable();

        return $this;
    }

    public function createLanguageKey(): self
    {
        $this->table()->unsignedBigInteger('language_id')->default(1);
        $this->table()->index('language_id');

        return $this;
    }

    public function createNextPrevFields(): self
    {
        $this->table()->unsignedInteger('prev_id')->nullable()->comment('Previous news id');
        $this->table()->unsignedInteger('next_id')->nullable()->comment('Next news id');

        return $this;

    }

    /**
     * @param string $column
     * @return \Illuminate\Database\Schema\ColumnDefinition
     */
    public function createNullableText(string $column): self
    {
        $this->table()->text($column)->nullable();

        return $this;
    }

    public function createNullableDateTime(string $column): self
    {
        $this->table()->dateTime($column)->nullable();

        return $this;
    }

    public function publishedAt()
    {
        return $this->createNullableDateTime('published_at');
    }

    public function createNullableString(string $column, int $length = 500): self
    {
        $this->table()->string($column, $length)->nullable();

        return $this;
    }

    public function table(): Blueprint
    {
        return $this->tableBlueprint;
    }

    public function addForeign($localOwnerKey, $ownerTable, $ownerKeyInOwnerTable = 'id'): self
    {
        $this->table()->foreign($localOwnerKey)
            ->references($ownerKeyInOwnerTable)->on($ownerTable)
            ->onUpdate('cascade')->onDelete('cascade')
        ;

        return $this;
    }

    public function belongsToUser($field = 'user_id', $nullable = false): self
    {
        tap($this->table()->unsignedBigInteger($field)->index(), function (ColumnDefinition $cd) use ($nullable) {
            !$nullable ?: $cd->nullable();
        });

        $this->addForeign($field, 'users');

        return $this;
    }

    public function belongsToOrder($field = 'order_id'): self
    {
        $this->table()->unsignedBigInteger($field)->index();
        $this->addForeign($field, 'orders');

        return $this;
    }

    public function belongsToCategory($field = 'category_id', $nullable = false): self
    {
        tap($this->table()->unsignedBigInteger($field)->index(), function (ColumnDefinition $cd) use ($nullable) {
            !$nullable ?: $cd->nullable();
        });
        $this->addForeign($field, 'categories');

        return $this;
    }

    public function getSelf($callable)
    {
        return $this;
    }

}