<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRedemptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redemption', function (Blueprint $table) {
            $table->id()->unique();
            $table->unsignedBigInteger('storeId');
            $table->string('name');
            $table->integer('points');
            $table->integer('discountAmount');
            $table->date('expirationDate');
            $table->integer('discountUnit');
            $table->string('couponCode', 7);
            $table->index('storeId');
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
        Schema::dropIfExists('redemption');
    }
}
