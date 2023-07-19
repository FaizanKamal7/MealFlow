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
        Schema::create('cities', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->boolean('active_status');
            $table->string('name');

            $table->uuid('state_id');
            $table->string('state_code');
            $table->uuid('country_id');
            $table->string('country_code');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->boolean('flag')->default(false);
            $table->string('wikiDataId')->nullable();

            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countires')->onDelete('cascade');
        });

        // Schema::table('cities', function (Blueprint $table) {


        //     $table->string('state_code');
        //     $table->uuid('country_id');
        //     $table->string('country_code');
        //     $table->string('latitude')->nullable();
        //     $table->string('longitude')->nullable();
        //     $table->boolean('flag')->default(false);
        //     $table->string('wikiDataId')->nullable();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
};
