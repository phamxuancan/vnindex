<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVnindexsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vnindexs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->string('thamchieu');
            $table->string('khoiluong');
            $table->string('nnmua');
            $table->string('nnban');
            $table->date('ngaythang');
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
        Schema::dropIfExists('vnindexs');
    }
}
