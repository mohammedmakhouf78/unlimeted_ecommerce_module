<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('CASCADE')->onUpdate('CASCADE');


            $table->unsignedBigInteger('product_details_id');
            $table->foreign('product_details_id')->references('id')->on('product_details')->onDelete('CASCADE')->onUpdate('CASCADE');


            $table->float('quantity', 8, 2)->default(0);
            $table->double('price', 8, 2)->default(0);
            $table->double('total', 8, 2)->default(0);
            $table->double('discount', 8, 2)->default(0);
            $table->double('total_after_discount', 8, 2)->default(0);
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
        Schema::dropIfExists('order_details');
    }
};
