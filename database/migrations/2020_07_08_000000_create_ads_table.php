<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\Schema::dropIfExists('ads');
        Schema::create('ads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('slug')->nullable();

            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->longText('features')->nullable();
            $table->longText('description')->nullable();

            $table->string('sku')->nullable();
            $table->string('upc')->nullable();
            $table->unsignedInteger('brand')->nullable();

            $table->unsignedInteger('product_id')->nullable();

            $table->decimal('price', 15, 4)->nullable();

            //0 =pending for review, 1= published, 2=blocked, 3=archived
            $table->enum('status', [0,1,2,3]);

            $table->date('expired_at')->nullable();
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
        Schema::drop('ads');
    }
}
