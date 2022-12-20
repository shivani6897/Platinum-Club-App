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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->index();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->unsignedBigInteger('product_log_id')->index();
            $table->foreign('product_log_id')->references('id')->on('product_logs')->onDelete('cascade');
            $table->string('invoice_number');
            $table->decimal('total_amount',8,2);
            $table->text('description')->nullable();
            $table->unsignedTinyInteger('payment_method')->default(0)->comment('0=offline,1=credit card,2=debit card');
            $table->string('card_token')->nullable();
            $table->unsignedTinyInteger('status')->default(0)->comment('0=sent,1=paid');
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
        Schema::dropIfExists('invoices');
    }
};
