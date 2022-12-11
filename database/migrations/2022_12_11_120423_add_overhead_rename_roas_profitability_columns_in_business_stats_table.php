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
        Schema::table('business_stats', function (Blueprint $table) {
            $table->renameColumn('roas','overheads');
            $table->decimal('net_profit', 9,2)->after('roas');
            $table->decimal('profitability',5,2)->after('net_profit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_stats', function (Blueprint $table) {
            $table->renameColumn('overheads','roas');
            $table->dropColumn(['net_profit','profitability']);
        });
    }
};
