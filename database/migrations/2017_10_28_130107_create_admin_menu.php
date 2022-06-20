<?php

use App\Traits\Migrations\MigrationCreateFieldTypes;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminMenu extends Migration
{
    use MigrationCreateFieldTypes;
    protected $table = 'admin_menus';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        
        Schema::create($this->table, function (Blueprint $table) {
            $this->setTable($table);
            $table->increments('id');
            $table->integer('parent_id')->default(0);
            $table->tinyInteger('active')->default(0);
            $table->string('name', 255)->nullable();
            $table->string('url', 255)->nullable();
            $table->string('gate_rule', 255)->nullable();
            $table->string('route', 255)->nullable();
            $table->string('image', 255)->nullable();
            $table->string('icon_font', 255)->nullable();
            $table->string('content_provider', 500)->nullable()
				->comment('');
            $table->text('option')->nullable();
            $table->text('description')->nullable();
            $table->smallInteger('sort')->nullable()->default(0);
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
        Schema::dropIfExists($this->table);
    }
}
