<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Characters;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        DB::connection('gs_data')->table('users')->insert([
            'username' => 'AdminUser',
            'email' => 'admin@example.com',
            'serial' => Str::random(32),
            'password' => bcrypt('password'), // Always hash passwords
            'ucp_ip' => '127.0.0.1',
            'adminlevel' => 15,
            #'banned' => false,
            #'ban_reason' => null,
            'jaildata' => json_encode([]), // Example of empty JSON data
            'factorcode' => null,
            'warndata' => json_encode([]),
        ]);

        $this->call([
            UserSeeder::class,
            CharacterSeeder::class,
            VehicleSeeder::class,
            SerialChangesSeeder::class,
            NameChangesSeeder::class,
            BansTableSeeder::class,
        ]);



    }
}
