<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->text('cart');
            $table->unsignedBigInteger('customerId')->nullable();
            $table->index('customerId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
