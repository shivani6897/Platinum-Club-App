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
        Schema::table('invoices', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('payments', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('products', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('product_logs', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('recurring_invoices', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('recurring_invoice_invoices', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('tasks', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('task_categories', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('user_habits', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('user_tokens', function (Blueprint $table) {
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
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('payments', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('product_logs', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('recurring_invoices', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('recurring_invoice_invoices', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('task_categories', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('user_habits', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('user_tokens', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
