<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLitigationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('litigations', function (Blueprint $table) {
            $table->id();           
            $table->string('name');
            $table->string('email');
            $table->integer('phone');
            $table->string('subject');
            $table->text('message');
            $table->string('status')->default('în așteptare');
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
        Schema::dropIfExists('litigations');
    }
}
