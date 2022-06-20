<?php

use App\Builders\Migration\MigrationBuilder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePages extends Migration
{

	/**
	 * @var MigrationBuilder
	 */
	private $builder;

	protected $table = 'pages';
	protected $foreignKey = 'page_id';
	protected $tableLang = 'page_langs';

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
				->createSort()
				->createUrl()
				->createActive()
				->createImage()
				->createImage('sub_image')
				->createNullableChar('page_type')
				->createNullableText('options')
			;
			$table->timestamps();

			$table->index('id');
		});
		//
		Schema::create($this->tableLang, function (Blueprint $table) {
			$this->builder->setTable($table);
			$table->unsignedBigInteger($this->foreignKey)->unsigned();
			$this->builder
				->addForeign($this->foreignKey, $this->table)
				->createLanguageKey()
				->createName()
				->createTitle()
				->createDescription()
				->createExcerpt()
				->createNullableChar('sub_title')
				->createNullableText('sub_description')
			;

		});
	}

	public function down()
	{
		Schema::dropIfExists($this->tableLang);
		Schema::dropIfExists($this->table);
	}
}
