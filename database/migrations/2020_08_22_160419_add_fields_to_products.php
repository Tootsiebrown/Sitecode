<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('size')->nullable();
            $table->string('expiration_date')->nullable();
            $table->string('dimensions')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ([
            'size',
            'expiration_date',
            'dimensions',
        ] as $column) {
            Schema::table('products', function (Blueprint $table) use ($column) {
                $table->dropColumn($column);
            });
        }

    }
}
