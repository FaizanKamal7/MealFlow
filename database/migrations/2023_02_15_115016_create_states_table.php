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
        Schema::create('states', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string('name');
            $table->string('country_code');
            $table->string('fips_code')->nullable();
            $table->string('iso2');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->boolean('flag')->default(0);
            $table->text('wikiDataId')->nullable();
            $table->boolean('active_status');
            $table->uuid('country_id');
            $table->softDeletes();

            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->timestamps();;
                });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('states');
    }
};
