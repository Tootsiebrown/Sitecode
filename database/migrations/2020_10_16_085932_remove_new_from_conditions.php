<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveNewFromConditions extends Migration
{
    protected $tables = [
        'products',
        'listings',
    ];

    protected $conditions = [
        'Sealed - New' => 'Sealed',
        'Sealed - Damaged Package' => 'Sealed - Damaged Package',

        'Open - New' => 'Open',
        'Open - Damaged or no Package' => 'Open - Damaged Package',

        'New with tags' => 'With Tags',
        'New without tags' => 'Without Tags',

        'Used' => 'Used',
        'Used - Damaged or no Package' => 'Used Damaged Package / Missing Package',
    ];
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->tables as $table) {
            foreach ($this->conditions as $old => $new) {
                DB::table($table)
                    ->where('condition', $old)
                    ->update(['condition' => $new]);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // the same, but with an array flip in there
        foreach ($this->tables as $table) {
            foreach (array_flip($this->conditions) as $old => $new) {
                DB::table($table)
                    ->where('condition', $old)
                    ->update(['condition' => $new]);
            }
        }
    }
}
