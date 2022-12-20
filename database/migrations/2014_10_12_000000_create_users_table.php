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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone_no');
            $table->string('city');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('profile')->nullable();
            $table->tinyInteger('role')->default(2)->comment('0=Super Admin, 1=Admin, 2=User');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            'first_name'=>'Super',
            'last_name'=>'Admin',
            'email'=>'admin@gmail.com',
            'phone_no'=>9000090000,
            'city'=>'Surat',
            'password'=>bcrypt('Admin@Platinum2022'),
            'role'=>0
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
