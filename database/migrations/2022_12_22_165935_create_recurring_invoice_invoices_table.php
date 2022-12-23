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
        Schema::create('recurring_invoice_invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recurring_invoice_id')->index();
            $table->foreign('recurring_invoice_id')->references('id')->on('recurring_invoices')->onDelete('cascade');
            $table->unsignedBigInteger('invoice_id')->index();
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recurring_invoice_invoice');
    }
};
