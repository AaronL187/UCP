<?php

namespace Database\Seeders;

use App\Models\Faction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Faction::factory()->count(10)->create();
    }
}
