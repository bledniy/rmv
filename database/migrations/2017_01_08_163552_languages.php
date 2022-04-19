<?php

	use App\Builders\Migration\MigrationBuilder;
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	class Languages extends Migration
	{
		/**
		 * @var MigrationBuilder
		 */
		private $builder;

		protected $table = 'languages';

		public function __construct()
		{
			$this->builder = app(MigrationBuilder::class);
		}

		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
			Schema::create($this->table, function (Blueprint $table) {
				$this->builder->setTable($table);
				$table->id();
				$this->builder
					->createSort()
					->createActive()
					->createDefault()
					->createName()
					->createNullableChar('key')
					->createNullableChar('icon')
				;
				$table->timestamps();

				$table->index('id');
			});
		}

		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down()
		{
			Schema::dropIfExists($this->table);
		}
	}
