<?php

use App\Traits\Migrations\MigrationCreateFieldTypes;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTranslates extends Migration
{
    use MigrationCreateFieldTypes;
    protected $table = 'translates';
    protected $tableLang = 'translate_lang';
    protected $primaryKey = 'translate_id';

    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $this->setTable($table);
            $table->increments('id');
            $table->char('key')->nullable();
            $table->string('comment')->nullable();
            $table->tinyInteger('module_id')->default(0);
            $table->string('group', 254)->nullable()->default('global');
            $table->string('type', 255)->default('text');
            $this->createNullableString('variables', 1000);
            $table->timestamps();

            $table->index('id');
        });

        Schema::create($this->tableLang, function (Blueprint $table) {
            $this->setTable($table);
            $table->integer($this->primaryKey)->unsigned();

            $table->text('value')->nullable();
            $table->smallInteger('language_id');
            //
            $table->index($this->primaryKey);
            $table->index('language_id');

            $table->foreign($this->primaryKey)
                ->references('id')->on($this->table)
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->tableLang);
        Schema::dropIfExists($this->table);
    }
}
