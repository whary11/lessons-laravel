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
            $table->id();

            $table->double('total', 100);
            $table->double('tax', 10)->comment('Impuestos aplicados.');
            $table->double('shipping_value', 10)->comment('Valor de envío.');

            $table->dateTime('delivery_date');

            
            $table->foreignId('user_id')->constrained();
            $table->foreignId('status_id')->constrained();

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
