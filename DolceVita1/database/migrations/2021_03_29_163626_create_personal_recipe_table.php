<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalRecipeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_recipe', function (Blueprint $table) {
            $table->id();         
            $table->foreignId('user_id')->constrained();
            $table->foreignId('recipe_id')->contsrained('recipes');
            $table->integer('qty')->nullable();
            $table->integer('weight')->nullable();
            $table->float('price',8, 2)->nullable();
            $table->string('note')->nullable();
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
        Schema::dropIfExists('personal_recipe');
    }
}
