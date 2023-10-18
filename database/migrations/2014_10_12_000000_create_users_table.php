<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->string('remeber_token')->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean("is_active")->default(true);
            $table->boolean("is_superuser")->default(false);
            $table->dateTime("last_login")->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
};
