<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_gateways', function (Blueprint $table) {
            $table->boolean('instamojo_active')->default(0);
            $table->text('instamojo_key')->nullable();
            $table->text('instamojo_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_gateways', function (Blueprint $table) {
            $table->dropColumn('instamojo_active');
        });
        Schema::table('payment_gateways', function (Blueprint $table) {
            $table->dropColumn('instamojo_key');
        });
        Schema::table('payment_gateways', function (Blueprint $table) {
            $table->dropColumn('instamojo_token');
        });
    }
};
