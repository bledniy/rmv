<?php

use App\Traits\Migrations\MigrationCreateFieldTypes;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenu extends Migration
{
    use MigrationCreateFieldTypes;

	protected $table = 'menus';
	protected $foreign = 'menu_id';
	protected $tableLang = 'menu_lang';


	public function up()
	{
		Schema::create($this->table, function (Blueprint $table) {
            $this->setTable($table);
			$table->increments('id');
			$table->tinyInteger('group');
			$table->integer('parent_id')->default(0);
			$table->tinyInteger('active')->default(1);
			$table->string('url', 160)->nullable();
			$table->string('icon', 255)->nullable()->comment('Шрифтовые изображения');
			$table->string('image', 255)->nullable()->comment('обычная картинка, впринципе любого типа');
			$table->smallInteger('sort')->default(0);
			$table->text('options')->nullable();
			$table->timestamps();

		});

		Schema::create($this->tableLang, function (Blueprint $table) {
            $this->setTable($table);
			$table->integer($this->foreign)->unsigned();

			$table->string('name', 255)->nullable();
			$table->smallInteger('language_id');
			//
			$table->index($this->foreign);
			$table->index('language_id');

			$table->foreign($this->foreign)
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
