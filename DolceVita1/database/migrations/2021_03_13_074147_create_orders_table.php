<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('user_id')->onDelete('set null')->onUpdate('cascade')->constrained();
            $table->string('email');
            $table->string('name');
            $table->string('region');
            $table->string('adress');
            $table->string('phone');
            $table->date('delivery_date');
            $table->float('discount')->nullable();
            $table->float('subtotal');
            $table->float('delivery_tax')->nullable();
            $table->float('total_amount');
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->default('în așteptare');
            $table->string('order_status')->default('în așteptare');
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
        Schema::dropIfExists('orders');
    }
}
