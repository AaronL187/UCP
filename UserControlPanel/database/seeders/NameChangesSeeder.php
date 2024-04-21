<?php

namespace Database\Seeders;

use App\Models\NameChange;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class NameChangesSeeder extends Seeder
{

    public function run(): void
    {
        \App\Models\NameChange::factory()->count(25)->create();
    }
}
