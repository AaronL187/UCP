<?php

namespace Database\Seeders;

use App\Models\Suggestion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuggestionSeeder extends Seeder
{
    protected $model = Suggestion::class;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        \App\Models\Suggestion::factory()->count(50)->create();
    }
}
