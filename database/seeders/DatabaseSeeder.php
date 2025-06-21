<?php

namespace Database\Seeders;

use App\Models\Dish;
use App\Models\Employee;
use App\Models\News;
use App\Models\Table;
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

        Employee::create([
            'password' => Hash::make('1234'),
            'isAdmin' => true,
        ]);
        News::create([
            'date' => Carbon::now(),
            'text' => 'Door de Corona crisis is De Gouden Draak op het moment slechts beperkt open.
                Het restaurant-gedeelte is gesloten. U kan uw favoriete gerechten nog wel afhalen.',
        ]);
        Table::create(['id' => 1]);
        Table::create(['id' => 3]);
        Table::create(['id' => 7]);
    }
}
