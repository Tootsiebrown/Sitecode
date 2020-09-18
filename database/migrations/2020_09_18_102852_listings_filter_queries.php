<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ListingsFilterQueries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('listings',
            fn(Blueprint $table) => $table->index(['status', 'brand_id', 'type'], 'status_brand_type')
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('listings',
            fn(Blueprint $table) => $table->dropIndex('status_brand_type')
        );
    }
}
