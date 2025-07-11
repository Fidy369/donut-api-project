<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonutsTable extends Migration
{
    public function up()
    {
        Schema::create('donuts', function (Blueprint $table) {
            $table->id();
            $table->string('api_id')->unique(); // API 'id' e.g. 0001
            $table->string('type');
            $table->string('name');
            $table->float('ppu');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('donuts');
    }
}
