<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

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
            'password' => bcrypt('password'), // Always hash passwords
            'ucp_ip' => '127.0.0.1',
            'adminlevel' => 15,
            'banned' => false,
            'ban_reason' => null,
            'jaildata' => json_encode([]), // Example of empty JSON data
            'factorcode' => null,
            'warndata' => json_encode([]),
        ]);

        DB::connection('gs_data')->table('users')->insert([
            'username' => 'ModeratorUser',
            'email' => 'moderator@example.com',
            'password' => bcrypt('password'),
            'ucp_ip' => '127.0.0.2',
            'adminlevel' => 5,
            'banned' => false,
            'ban_reason' => null,
            'jaildata' => json_encode([]),
            'factorcode' => null,
            'warndata' => json_encode([]),
        ]);

        DB::connection('gs_data')->table('users')->insert([
            'username' => 'RegularUser',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'ucp_ip' => '127.0.0.3',
            'adminlevel' => 0,
            'banned' => false,
            'ban_reason' => null,
            'jaildata' => json_encode([]),
            'factorcode' => null,
            'warndata' => json_encode([]),
        ]);
    }
}
