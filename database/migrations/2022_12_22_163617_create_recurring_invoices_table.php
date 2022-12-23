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
        Schema::create('recurring_invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('customer_id')->index();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->unsignedBigInteger('product_id')->index();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->decimal('downpayment',8,2)->default(0);
            $table->decimal('paid',8,2);
            $table->decimal('pending',8,2);
            $table->decimal('emi_amount',8,2);
            $table->date('paid_date');
            $table->date('next_emi_date');
            $table->unsignedInteger('paid_emis')->default(0);
            $table->unsignedInteger('total_emis')->default(1);
            $table->unsignedTinyInteger('status')->default(0)->comment('0=pending,1=paid,2=overdue,3=fully paid');
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
        Schema::dropIfExists('recurring_invoices');
    }
};
