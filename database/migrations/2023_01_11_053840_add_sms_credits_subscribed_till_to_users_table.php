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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('sms_credits')->default(0)->after('role');
            $table->date('subscribed_till')->nullable()->after('sms_credits');
            $table->unsignedBigInteger('state_id')->nullable()->index()->after('phone_no');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('restrict');
            $table->dropColumn(['city']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign([
                'state_id'
            ]);
            $table->string('city')->nullable()->after('phone_no');
            $table->dropColumn([
                'sms_credits',
                'subscribed_till',
                'state_id',
            ]);
        });
    }
};
