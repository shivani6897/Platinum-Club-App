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
        Schema::create('business_stats', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->date('month');
            $table->decimal('revenue_earned', 9,2);
            $table->decimal('ad_spends', 9,2);
            $table->decimal('avg_cost_per_lead', 9,2);
            $table->decimal('leads_generated', 9,2);
            $table->decimal('paid_customer', 9,2);
            $table->decimal('group_size', 9,2);
            $table->decimal('roas', 9,2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_stats');
    }
};
