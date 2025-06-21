<?php

use App\Models\Dish;
use App\Models\Order;
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
        Schema::create('order_lines', function (Blueprint $table) {
            $table->foreignId('order_id')
                ->constrained('orders')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('dish_id')
                ->constrained('dishes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->primary(['order_id', 'dish_id']);
            $table->integer('amount');
            $table->decimal('original_dishprice', 5, 2);
            $table->string('extra_information', 200)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_lines');
    }
};
