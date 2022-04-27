<?php declare(strict_types=1);

use App\Builders\Migration\MigrationBuilder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{

   /**
    * @var MigrationBuilder
   */
   private $builder;

   private $table = 'staffs';

   private $foreignKey = 'staff_id';

   private $tableLang = 'staff_langs';

   public function __construct()
   {
       $this->builder = app(MigrationBuilder::class);
   }


   public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $this->builder->setTable($table);

            $table->id();
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('faculty_id');
            $this->builder
                ->createNullableChar('mail')
                ->createNullableChar('phone')
                ->createNullableChar('type')
                ->createImage()
                ->createSort()
                ->createActive()
            ;
            $table->timestamps();

            $this->builder->addForeign('department_id', 'departments');
            $this->builder->addForeign('faculty_id', 'faculties');
        });


        Schema::create($this->tableLang, function (Blueprint $table) {
            $this->builder->setTable($table);
            $table->unsignedBigInteger($this->foreignKey);

            $this->builder
                ->createName()
                ->createDescription()
                ->createLanguageKey()
            ;
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
