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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('task_category_id')->index();
            $table->foreign('task_category_id')->references('id')->on('task_categories')->onDelete('cascade');
            $table->string('name');
            $table->boolean('type')->default(0)->comment('0=One time, 1=Recurring');
            $table->dateTime('task_date')->nullable()->comment('For One time task');
            $table->date('start_date')->nullable()->comment('For Recurring');
            $table->date('end_date')->nullable()->comment('For Recurring');
            $table->time('task_time')->nullable()->comment('For Recurring');
            $table->unsignedTinyInteger('frequency')->default(0)->comment('0=no repeat, 1=daily, 2=bi-weekly, 3=weekly, 4=monthly');
            $table->string('day_of_week')->nullable()->comment('For Recurring');
            $table->string('day_of_week_2')->nullable()->comment('For Recurring');
            $table->unsignedInteger('month_day')->nullable()->comment('FOr recurring');

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
        Schema::dropIfExists('tasks');
    }
};
