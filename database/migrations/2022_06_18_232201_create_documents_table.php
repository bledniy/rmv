<?php declare(strict_types=1);

use App\Builders\Migration\MigrationBuilder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{

   /**
    * @var MigrationBuilder
   */
   private $builder;

   private $table = 'documents';

   private $foreignKey = 'document_id';

   private $tableLang = 'document_langs';

    public function __construct()
    {
        $this->builder = app(MigrationBuilder::class);
    }

    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $this->builder->setTable($table);

            $table->id();
            $this->builder
                ->createFile()
                ->createActive()
                ->createNextPrevFields()
                ->publishedAt()
            ;
            $table->index('published_at');

            $table->timestamps();
        });

        Schema::create($this->tableLang, function (Blueprint $table) {
            $this->builder->setTable($table);
            $table->unsignedBigInteger($this->foreignKey);

            $this->builder
                ->createName()
                ->createTitle()
                ->createDescription()
                ->createExcerpt()
                ->createLanguageKey()
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
