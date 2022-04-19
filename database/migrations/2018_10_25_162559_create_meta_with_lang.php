<?php

use App\Traits\Migrations\MigrationCreateFieldTypes;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetaWithLang extends Migration
{

    use MigrationCreateFieldTypes;

    protected $table = 'meta';
    protected $foreign = 'meta_id';
    protected $tableLang = 'meta_lang';

    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $this->setTable($table);
            $table->increments('id');
            $table->char('url', 160)->unique();
            $table->tinyInteger('type')->default(0);
            $table->tinyInteger('active')->default(1);
            $table->timestamps();

            $table->text('header')->nullable()->comment('html/js etc code for header');
            $table->text('footer')->nullable()->comment('html/js etc code for footer');

            $table->index('id');
        });

        Schema::create($this->tableLang, function (Blueprint $table) {
            $this->setTable($table);
            $table->integer($this->foreign)->unsigned();

            $table->string('h1', 255)->nullable();
            $table->string('title', 255)->nullable();
            $table->string('keywords', 500)->nullable();
            $table->string('description', 1000)->nullable();
            $table->text('text_top')->nullable();
            $table->mediumText('text_bottom')->nullable();
            $table->smallInteger('language_id');
            //
            $table->index($this->foreign);
            $table->index('language_id');

            $table->foreign($this->foreign)
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
