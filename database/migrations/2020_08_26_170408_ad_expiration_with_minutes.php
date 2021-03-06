<?php

use Illuminate\Support\Carbon;
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
        $table = Schema::hasTable('listings')
            ? 'listings'
            : 'ads';

        $ads = Db::table($table)->select('*')->get();
        Schema::table($table, function (Blueprint $table) {
            $table->dropColumn('expired_at');
        });

        Schema::table($table, function (Blueprint $table) {
            $table->dateTime('expired_at')->nullable();
        });

        foreach($ads as $ad) {
            if (is_null($ad->expired_at)) {
                continue;
            }

            $expiration = Carbon::createFromFormat('Y-m-d', $ad->expired_at)
                ->setHour(23)
                ->setMinute(59)
                ->setSecond(0);

            Db::table($table)
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
        $ads = Db::table($table)->select('*')->get();
        Schema::table($table, function (Blueprint $table) {
            $table->dropColumn('expired_at');
        });

        Schema::table($table, function (Blueprint $table) {
            $table->date('expired_at')->nullable();
        });

        foreach($ads as $ad) {
            DB::table($table)
                ->where('id', $ad->id)
                ->update(['expired_at' => $ad->expired_at]);
        }
    }
}
