<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'products';

    /**
     * Run the migrations.
     * @table products
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedInteger('brand')->nullable();
            $table->string('upc')->nullable();
            $table->string('name');

            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->longText('features')->nullable();
            $table->longText('description')->nullable();

            $table->decimal('price', 15, 4)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->set_schema_table);
    }
}
