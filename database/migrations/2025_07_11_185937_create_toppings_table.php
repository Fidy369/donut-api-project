<?php

// database/migrations/xxxx_xx_xx_create_toppings_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToppingsTable extends Migration
{
    public function up()
    {
        Schema::create('toppings', function (Blueprint $table) {
            $table->id();
            $table->string('api_id'); // API 'id' e.g. 5002
            $table->string('type');
            $table->foreignId('donut_id')->constrained('donuts')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('toppings');
    }
}
