<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUtsUhUasTugasToMapelSiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mapel_siswa', function (Blueprint $table) {
            $table->integer('tugas')->nullable()->after('nilai');
            $table->integer('uh')->nullable()->after('nilai');
            $table->integer('uts')->nullable()->after('nilai');
            $table->integer('uas')->nullable()->after('nilai');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mapel_siswa', function (Blueprint $table) {
            //
        });
    }
}
