<?php

use App\Builders\Migration\MigrationBuilder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
	private $builder;

	public function __construct()
	{
		$this->builder = app(MigrationBuilder::class);
	}

	public function up()
	{
		Schema::create('images', function (Blueprint $table) {
			$this->builder->setTable($table);
			$table->bigIncrements('id');
			$table->nullableMorphs('imageable');
			//
			$this->builder
				->createActive()
				->createName()
				->createImage()
				->createSort()
				->createNullableChar('type')
			;
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('images');
	}
}
