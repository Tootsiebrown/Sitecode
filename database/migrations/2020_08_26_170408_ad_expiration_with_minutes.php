<?php

use App\Ad;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdExpirationWithMinutes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $ads = Ad::all();
        Schema::table('ads', function (Blueprint $table) {
            $table->dropColumn('expired_at');
        });

        Schema::table('ads', function (Blueprint $table) {
            $table->dateTime('expired_at')->nullable();
        });

        foreach($ads as $ad) {
            $expiration = $ad->expired_at
                ->setHour(23)
                ->setMinute(59)
                ->setSecond(0);

            Db::table('ads')
                ->where('id', $ad->id)
                ->update(['expired_at' => $expiration->toDateTimeString()]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $ads = Ad::all();
        Schema::table('ads', function (Blueprint $table) {
            $table->dropColumn('expired_at');
        });

        Schema::table('ads', function (Blueprint $table) {
            $table->date('expired_at')->nullable();
        });

        foreach($ads as $ad) {
            DB::table('ads')
                ->where('id', $ad->id)
                ->update(['expired_at' => $ad->expired_at]);
        }
    }
}
