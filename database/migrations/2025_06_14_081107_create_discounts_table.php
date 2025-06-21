<?php

use App\Models\Dish;
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
        Schema::create('discounts', function (Blueprint $table) {
            $table->foreignId('dish_id')
                ->constrained('dishes', 'id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->date('start_date');
            $table->primary(['dish_id', 'start_date']);
            $table->date('end_date');
            $table->integer('discount_percentage');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
