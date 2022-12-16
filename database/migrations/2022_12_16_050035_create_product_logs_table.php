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
        Schema::create('product_logs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price',8,2);
            $table->unsignedInteger('qty')->default(1);
            $table->decimal('setup_fee',8,2)->default(0);
            $table->boolean('type')->default(0)->comment('0=Flat,1=Monthly,2="Yearly');
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
        Schema::dropIfExists('product_logs');
    }
};
