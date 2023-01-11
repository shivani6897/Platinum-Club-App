<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        DB::statement("INSERT INTO states (id,name) VALUES 
            ( 1, 'Andaman & Nicobar Islands' ),
            ( 2, 'Andhra Pradesh' ),
            ( 3, 'Arunachal Pradesh' ),
            ( 4, 'Assam' ),
            ( 5, 'Bihar' ),
            ( 6, 'Chandigarh' ),
            ( 7, 'Chhattisgarh' ),
            ( 8, 'Dadra & Nagar Haveli' ),
            ( 9, 'Daman & Diu' ),
            ( 10, 'Delhi' ),
            ( 11, 'Goa' ),
            ( 12, 'Gujarat' ),
            ( 13, 'Haryana' ),
            ( 14, 'Himachal Pradesh' ),
            ( 15, 'Jammu & Kashmir' ),
            ( 16, 'Jharkhand' ),
            ( 17, 'Karnataka' ),
            ( 18, 'Kerala' ),
            ( 19, 'Lakshadweep' ),
            ( 20, 'Madhya Pradesh' ),
            ( 21, 'Maharashtra' ),
            ( 22, 'Manipur' ),
            ( 23, 'Meghalaya' ),
            ( 24, 'Mizoram' ),
            ( 25, 'Nagaland' ),
            ( 26, 'Odisha' ),
            ( 27, 'Puducherry' ),
            ( 28, 'Punjab' ),
            ( 29, 'Rajasthan' ),
            ( 30, 'Sikkim' ),
            ( 31, 'Tamil Nadu' ),
            ( 32, 'Telangana' ),
            ( 33, 'Tripura' ),
            ( 34, 'Uttar Pradesh' ),
            ( 35, 'Uttarakhand' ),
            ( 36, 'West Bengal' );");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('states');
    }
};
