<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_variation_order', function (Blueprint $table) {
            $table->integer('product_variation_id')->unsigned()->index();
            $table->integer('order_id')->unsigned()->index();
            $table->integer('quantity')->unsigned();

            $table->timestamps();

            $table->foreign('product_variation_id')->references('id')->on('product_variations');
            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_variation_order', function (Blueprint $table) {
            //
        });
    }
};
