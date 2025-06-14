<?php

use App\Models\DishType;
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
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->integer('number')->nullable();
            $table->string('menu_addition', 2)->nullable();
            $table->string('name', 50);
            $table->decimal('price', 5, 2);
            $table->string('description', 300)->nullable();
            $table->boolean('visible');
            $table->string('dish_type', 100);
            $table->foreign('dish_type')->references('type')->on('dish_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dishes');
    }
};
