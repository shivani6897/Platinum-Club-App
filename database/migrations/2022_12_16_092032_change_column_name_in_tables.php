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
        Schema::table('customers', function (Blueprint $table) {
            $table->renameColumn('customer_name', 'name');
        });

        Schema::table('expenses', function (Blueprint $table) {
            $table->renameColumn('start_date', 'date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->renameColumn('name', 'customer_name');
        });

        Schema::table('expenses', function (Blueprint $table) {
            $table->renameColumn('date', 'start_date');
        });
    }
};
