<?php declare(strict_types=1);

use App\Builders\Migration\MigrationBuilder;
use App\Traits\Migrations\MigrationCreateFieldTypes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidersTable extends Migration
{
	use MigrationCreateFieldTypes;
	protected $table = 'sliders';
	protected $foreign = 'slider_id';
	protected $tableLang = 'slider_item_lang';

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create($this->table, function (Blueprint $table) {
			$this->setTable($table);
			$table->bigIncrements('id');
			$this->createActive();
			$this->createNullableChar('comment');
			$table->text('options')->nullable();
			$table->char('key')->nullable()->index();
			$table->timestamps();
		});

		Schema::create('slider_items', function (Blueprint $table) {
			$this->setTable($table);
			$table->bigIncrements('id');
			$table->unsignedBigInteger($this->foreign)->index();
			$this->createActive();
			$this->createSort();
			$this->createNullableString('link', 500);
			$table->enum('type', ['image', 'video'])->default('image');
			$this->createNullableString('src', 500);
			$table->foreign($this->foreign)
				->references('id')->on($this->table)
				->onUpdate('cascade')->onDelete('cascade');
		});
		//
		Schema::create($this->tableLang, function (Blueprint $table) {
			$this->setTable($table);
			$table->unsignedBigInteger('slider_item_id')->index();
			$table->integer('language_id');
			$table->string('name', 255)->nullable();
			$this->createDescription();
			$this->createExcerpt();
			//
			$table->index('language_id');
			$table->foreign('slider_item_id')
				->references('id')->on('slider_items')
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
		Schema::dropIfExists('slider_items');
		Schema::dropIfExists($this->table);
	}
}
