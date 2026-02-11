<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Remove duplicates - keep only the latest record per ic_number
        $duplicates = DB::table('keahlian')
            ->select('ic_number')
            ->groupBy('ic_number')
            ->havingRaw('COUNT(*) > 1')
            ->pluck('ic_number');

        foreach ($duplicates as $ic) {
            $idsToKeep = DB::table('keahlian')->where('ic_number', $ic)->orderBy('id', 'desc')->limit(1)->pluck('id');
            DB::table('keahlian')->where('ic_number', $ic)->whereNotIn('id', $idsToKeep)->delete();
        }

        Schema::table('keahlian', function (Blueprint $table) {
            $table->unique('ic_number');
        });
    }

    public function down()
    {
        Schema::table('keahlian', function (Blueprint $table) {
            $table->dropUnique(['ic_number']);
        });
    }
};
