<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('listing_id')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->decimal('price', 15, 4);
            $table->timestamp('responded_at')->nullable();
            $table->text('response')->nullable();
            $table->integer('counter_quantity')->nullable()->unsigned();
            $table->decimal('counter_price', 15, 4)->nullable();
            $table->text('response_message')->nullable();
            $table->timestamp('counter_responded_at')->nullable();
            $table->boolean('counter_accepted')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offers');
    }
}
