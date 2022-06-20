<?php

use App\Traits\Migrations\MigrationCreateFieldTypes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{

    use MigrationCreateFieldTypes;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $this->setTable($table);
            $table->id();
            $table->string('key')->unique();
            $table->string('display_name')->nullable();
            $table->longText('value')->nullable();
            $table->text('details')->nullable();
            $table->string('type')->nullable();
            $table->integer('sort')->default('0');
            $table->string('group')->nullable();
            $table->unsignedBigInteger('user_id')->nullable()->comment('Last edited by user');
            $table->unsignedBigInteger('deleted_by')->nullable()->comment('Deleted by user');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
}
