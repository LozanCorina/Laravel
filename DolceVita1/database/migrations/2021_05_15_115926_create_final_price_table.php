<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinalPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('final_price', function (Blueprint $table) {
            $table->string('id_reteta');
            $table->float('pret_mat');
            $table->float('c_salarii');
            $table->float('CAS');
            $table->float('c_indirecte');
            $table->float('pret_net');
            $table->float('adaos');
            $table->float('pret_final');
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
        Schema::dropIfExists('final_price');
    }
}
