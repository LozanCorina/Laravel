<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_order', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categorie_id')->contsrained('categories');
            $table->foreignId('user_id')->constrained();
            $table->integer('qty')->nullable();
            $table->integer('weight')->nullable();
            $table->float('price',8, 2)->nullable();
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
        Schema::dropIfExists('personal_order');
    }
}
