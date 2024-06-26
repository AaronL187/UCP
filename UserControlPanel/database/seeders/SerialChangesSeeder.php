<?php

namespace Database\Seeders;

use App\Models\SerialChange;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SerialChangesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\SerialChange::factory()->count(50)->create();
    }
}
