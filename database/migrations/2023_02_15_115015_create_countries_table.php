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
        Schema::create('countries', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string('name');
            $table->boolean('flag')->nullable();
            $table->string('iso3');
            $table->string('iso2');
            $table->string('phonecode');
            $table->string('capital');
            $table->string('currency');
            $table->string('currency_symbol');
            $table->string('tld');
            $table->string('native')->nullable();
            $table->string('region');
            $table->string('subregion');
            $table->text('timezones');
            $table->text('translations')->nullable();
            $table->text('latitude');
            $table->text('longitude');
            $table->text('emoji');
            $table->text('emojiU');
            $table->text('wikiDataId')->nullable();
            $table->boolean('active_status')->default(false);
            $table->softDeletes();
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
        Schema::dropIfExists('countries');
    }
};
