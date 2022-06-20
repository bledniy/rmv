<?php

use App\Traits\Migrations\MigrationCreateFieldTypes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRedirects extends Migration
{
	use MigrationCreateFieldTypes;

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('redirects', function (Blueprint $table) {
			$this->setTable($table);
			$table->bigIncrements('id');
			$table->string('from', 191)->unique()->nullable();
			$table->string('to', 191)->unique()->nullable();
			$table->string('code');
			$this->createActive();

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
		Schema::dropIfExists('redirects');
	}
}
