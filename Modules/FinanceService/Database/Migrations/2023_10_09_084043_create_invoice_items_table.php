<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('item_type'); // DELIVERY SLOT PRICING, RANGE_PRICING
            $table->string('item_info')->nullable(); // JSON
            $table->uuidMorphs('service'); // This creates 'service_type' and 'service_id' columns
            $table->decimal('amount', 8, 2);
            $table->uuid('invoice_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_items');
    }
};
