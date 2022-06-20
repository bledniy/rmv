<?php

use App\Builders\Migration\MigrationBuilder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{

	/**
	 * @var MigrationBuilder
	 */
	private $builder;

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
		Schema::create('users', function (Blueprint $table) {
			$this->builder->setTable($table);
			$table->bigIncrements('id');
			$table->string('email')->unique()->nullable();
			$table->string('phone')->unique()->nullable();
			$table->timestamp('email_verified_at')->nullable();
			$table->timestamp('phone_verified_at')->nullable();
			$table->timestamp('authenticated_at')->nullable();
			$table->string('password');
			$this->builder->createActive();
			$table->ipAddress('last_login_ip')->nullable();
			$table->string('user_agent')->nullable();
			$table->rememberToken();
			$table->char('slug')->nullable()->index();

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
		Schema::dropIfExists('users');
	}
}
