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
            $table->string('OrderID');
            $table->string('PrtID');
            $table->string('Username');
            $table->string('PrtName');
            $table->string('PrtQty');
            $table->string('PrtPrice');
            $table->string('PrtImage');
            $table->string('TotalPrice');
            $table->string('Status');
            $table->string('Address');
            $table->string('DateTime');
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
