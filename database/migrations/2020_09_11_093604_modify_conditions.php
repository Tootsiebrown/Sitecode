<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyConditions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('products')
            ->where('condition', 'Sealed, Unopened')
            ->update(['condition' => 'Sealed - New']);
        DB::table('listings')
            ->where('condition', 'Sealed, Unopened')
            ->update(['condition' => 'Sealed - New']);

        DB::table('products')
            ->where('condition', 'Sealed, Damaged Package')
            ->update(['condition' => 'Sealed - Damaged Package']);
        DB::table('listings')
            ->where('condition', 'Sealed, Damaged Package')
            ->update(['condition' => 'Sealed - Damaged Package']);

        DB::table('products')
            ->where('condition', 'Opened, Unused')
            ->update(['condition' => 'Open - New']);
        DB::table('listings')
            ->where('condition', 'Opened, Unused')
            ->update(['condition' => 'Open - New']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        throw new \Exception('This migration cannot happen down without some additional logic for translation');
    }
}
