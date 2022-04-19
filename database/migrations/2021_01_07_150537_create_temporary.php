<?php

use App\Builders\Migration\MigrationBuilder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemporary extends Migration
{
	private $builder;

	private $table = 'temporary';

	public function __construct()
	{
		$this->builder = app(MigrationBuilder::class);
	}

	public function up()
	{
		Schema::create($this->table, function (Blueprint $table) {
			$this->builder->setTable($table);
			$table->id();
			$table->string('key', 190)->nullable()->index();
			$table->char('type', 255)->nullable()->index();
			$table->boolean('deletable')->default(true);
			$table->mediumText('value')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists($this->table);
	}
}
