<?php declare(strict_types=1);

use App\Builders\Migration\MigrationBuilder;
use App\Contents\ContentFieldsTypeInterface;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContents extends Migration
{
    private $builder;

    private $table = 'contents';

    private $foreignKey = 'content_id';

    private $tableLang = 'content_langs';

    public function __construct()
    {
        $this->builder = app(MigrationBuilder::class);
    }

    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $this->builder->setTable($table);

            $table->id();
            $table->nullableMorphs('contentable');
            $this->builder
                ->createType('type', '')
                ->createType('content_type')
                ->createUrl()
                ->createImage()
                ->createImage(ContentFieldsTypeInterface::ADDITIONAL_IMAGE)
                ->createSort()
                ->createActive()
            ;
            $table->timestamps();
        });

        Schema::create($this->tableLang, function (Blueprint $table) {
            $this->builder->setTable($table);
            $table->unsignedBigInteger($this->foreignKey);
            $this->builder
                ->createLanguageKey()
                ->createName()
                ->createNullableString('title')
                ->createExcerpt()
                ->createDescription()
            ;

            $this->builder->addForeign($this->foreignKey, $this->table);
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->tableLang);
        Schema::dropIfExists($this->table);
    }
}
