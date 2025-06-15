<?php

namespace Database\Seeders;

use App\Models\Dish;
use App\Models\Employee;
use App\Models\News;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Employee::factory()->create();
        Dish::factory(100)->create();
        News::create([
            'date' => Carbon::now(),
            'text' => 'Door de Corona crisis is De Gouden Draak op het moment slechts beperkt open.
                Het restaurant-gedeelte is gesloten. U kan uw favoriete gerechten nog wel afhalen.',
        ]);
    }
}
