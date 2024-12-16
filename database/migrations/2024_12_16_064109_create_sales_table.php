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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('region');
            $table->string('country');
            $table->string('item_type');
            $table->string('sales_channel');
            $table->string('order_priority');
            $table->string('order_date');
            $table->string('order_id');
            $table->string('ship_date');
            $table->string('units_sold');
            $table->string('unit_price');
            $table->string('unit_cost');
            $table->string('total_revenue');
            $table->string('total_cost');
            $table->string('total_profit');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
