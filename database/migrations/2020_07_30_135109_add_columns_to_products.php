<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('color')->nullable();

            //0 = used, 1 = new
            $table->enum('condition', [0,1]);

            $table->string('gender')->nullable();
            $table->string('model_number')->nullable();
            $table->decimal('original_price', 15, 4)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('color');
            $table->dropColumn('condition');
            $table->dropColumn('gender');
            $table->dropColumn('model_number');
            $table->dropColumn('original_price');
        });
    }
}
