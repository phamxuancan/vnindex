<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('symbol',8)->unique();
            $table->string('object');
            $table->string('company');
            $table->string('companyName');
            $table->string('companyNameEng');
            $table->string('shortName');
            $table->string('status');
            $table->string('floor')->nullable();
            $table->string('industryName')->nullable();
            $table->string('listedDate')->nullable();
            $table->string('delistedDate')->nullable();
            $table->string('indexCode')->nullable();
            $table->string('pe')->nullable();
            $table->string('eps')->nullable();
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
        Schema::dropIfExists('stocks');
    }
}
