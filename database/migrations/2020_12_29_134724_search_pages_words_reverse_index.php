<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SearchPagesWordsReverseIndex extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('search_pages_words', function (Blueprint $table) {
            $table->unique(['stem', 'page_id'], 'search_pages_words_stem_page_id_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('search_pages_words', function (Blueprint $table) {
            $table->dropIndex('search_pages_words_stem_page_id_unique');
        });
    }
}
