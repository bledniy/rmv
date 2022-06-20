<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
	        $table->string('login')->unique()->nullable();
	        $table->timestamp('authenticated_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
	        $table->string('locale', 20)->default(\Config::get('app.locale'));
	        $table->ipAddress('last_login_ip')->nullable();
	        $table->string('user_agent')->nullable();
	        $table->boolean('active')->default(1);
            $table->string('password')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('admins');
    }
}