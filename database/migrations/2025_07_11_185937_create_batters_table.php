<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBattersTable extends Migration
{
    public function up()
    {
        Schema::create('batters', function (Blueprint $table) {
            $table->id();
            $table->string('api_id'); // API 'id' e.g. 1001
            $table->string('type');
            $table->foreignId('donut_id')->constrained('donuts')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('batters');
    }
}
