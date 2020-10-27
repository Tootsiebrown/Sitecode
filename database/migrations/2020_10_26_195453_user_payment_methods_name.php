<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserPaymentMethodsName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_payment_methods', function (Blueprint $table) {
            $table->dropColumn('lastname');
        });

        Schema::table('user_payment_methods', function (Blueprint $table) {
            $table->dropColumn('firstname');
        });

        Schema::table('user_payment_methods', function (Blueprint $table) {
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_payment_methods', function (Blueprint $table) {
            $table->string('lastname')->nullable();
        });

        Schema::table('user_payment_methods', function (Blueprint $table) {
            $table->string('firstname')->nullable();
        });

        Schema::table('user_payment_methods', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }
}
