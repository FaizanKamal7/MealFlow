<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('start_date');
            $table->date('end_date');
            $table->date('invoice_date');

            $table->decimal('total_amount', 10, 2);
            $table->decimal('paid_amount', 10, 2)->nullable(); // Amount paid for the invoice
            $table->enum('status', ['unpaid', 'paid', 'partial'])->default('unpaid'); // Invoice status: unpaid, paid, or partial
            $table->date('paid_date')->nullable(); // Date when the invoice was paid
            $table->string('payment_method')->nullable(); // Payment method used (e.g., cash, credit card, bank transfer, etc.)
            $table->boolean('is_sent')->default(false); 

            $table->uuid('business_id')->nullable();

            // Timestamps
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("business_id")->references("id")->on("businesses")->onDelete("set null");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};
