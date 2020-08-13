<?php

use App\Ad;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdsLikeProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ads', function (Blueprint $table) {
            $table->dropColumn('brand');
            $table->unsignedInteger('brand_id')->nullable();

            $table->decimal('original_price', 15, 4)->nullable();
            $table->string('condition')->default(Ad::getConditions()[0]);
            $table->string('gender')->nullable();
            $table->string('model_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ads', function (Blueprint $table) {
            $table->unsignedInteger('brand')->nullable();
        });

        foreach ([
            'original_price',
            'condition',
            'gender',
            'model_number',
            'brand_id',
        ] as $column) {
            Schema::table('ads', function (Blueprint $table) use ($column) {
                $table->dropColumn($column);
            });
        }
    }
}
