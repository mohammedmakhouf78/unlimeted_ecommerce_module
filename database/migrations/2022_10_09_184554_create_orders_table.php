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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('id');
            $table->integer('orderable_id');
            $table->string("orderable_type");
            $table->double('total', 8, 2)->default(0);
            $table->double('discount', 8, 2)->default(0);
            $table->double('total_after_discount', 8, 2)->default(0);
            $table->double('paid', 8, 2)->default(0);
            $table->double('total_payed', 8, 2)->default(0);
            $table->double('left', 8, 2)->default(0);
            $table->enum('status', ['open', 'closed']);
            $table->enum('type', ['sell', 'buy']);
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
};
