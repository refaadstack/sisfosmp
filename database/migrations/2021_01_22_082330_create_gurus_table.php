<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGurusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gurus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('nama');
            $table->string('nip')->nullable();
            $table->string('jeniskelamin');
            $table->string('tempatlahir');
            $table->date('tanggallahir');
            $table->string('agama')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('avatar')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gurus');
    }
}
