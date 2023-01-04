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
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('is_free_trial')->default(false)->after('name');
            $table->integer('trial_duration')->after('is_free_trial')->nullable();
            $table->string('trial_duration_type')->after('trial_duration')->nullable();
            $table->decimal('trial_price',8,2)->after('trial_duration_type')->default(0.00);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'is_free_trial',
                'trial_duration',
                'trial_duration_type',
                'trial_price',
            ]);
        });
    }
};
