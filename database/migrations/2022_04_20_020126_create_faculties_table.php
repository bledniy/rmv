<?php declare(strict_types=1);

use App\Builders\Migration\MigrationBuilder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacultiesTable extends Migration
{

    /**
     * @var MigrationBuilder
     */
    private $builder;

    private $table = 'faculties';

    private $foreignKey = 'faculties_id';

    private $tableLang = 'faculties_langs';

    public function __construct()
    {
        $this->builder = app(MigrationBuilder::class);
    }


    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $this->builder->setTable($table);

            $table->id();
            $this->builder
                ->createImage()
                ->createSort()
                ->createActive();
            $table->timestamps();
        });


        Schema::create($this->tableLang, function (Blueprint $table) {
            $this->builder->setTable($table);
            $table->unsignedBigInteger($this->foreignKey);

            $this->builder
                ->createName()
                ->createTitle()
                ->createLongDescription()
                ->createExcerpt();

            $table->foreign($this->foreignKey)
                ->references('id')->on($this->table)
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists($this->tableLang);
        Schema::dropIfExists($this->table);
    }
}
