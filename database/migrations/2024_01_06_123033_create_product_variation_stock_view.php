<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
       CREATE VIEW product_variation_stock_view AS
       SELECT 
       product_variations.product_id AS product_id,
       product_variations.id AS product_variation_id,
       coalesce(SUM(stocks.quantity) - coalesce((product_variation_order.quantity), 0), 0) as stock,
       CASE WHEN coalesce(SUM(stocks.quantity) - coalesce((product_variation_order.quantity), 0), 0) > 0
       THEN true
       ELSE false
       END in_stock
       FROM product_variations
       LEFT JOIN (
           SELECT 
           stocks.product_variation_id AS id,
           SUM(stocks.quantity) as quantity
           FROM stocks
           group by stocks.product_variation_id
       ) AS stocks USING (id) 
       
       LEFT JOIN (
           SELECT
           product_variation_order.product_variation_id as id,
           SUM(product_variation_order.quantity) as quantity
           FROM product_variation_order
           GROUP BY product_variation_order.product_variation_id
       ) AS product_variation_order USING (id)
       GROUP BY product_variations.id");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXIST product_variation_stock_view");
    }
};
