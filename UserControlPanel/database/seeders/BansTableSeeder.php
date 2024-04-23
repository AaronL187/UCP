<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class BansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Set the database connection to gs_data
        $users = DB::connection('gs_data')->table('users')->get();

        foreach ($users as $user) {
            // Randomly decide to ban the user or not
            if (Arr::random([true, false])) { // 50% chance to ban
                DB::connection('gs_data')->table('bans')->insert([
                    'userid'       => $user->id,
                    'username'     => $user->username,
                    'banned_until' => now()->addDays(rand(10, 60)), // Ban duration between 10 to 60 days
                    'is_banned'    => true,
                    'banned_by'    => 'Admin', // Example admin name, adjust as needed
                    'reason'       => 'Example reason for ban',
                    'unbanned_by'  => null,
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ]);
    }
}
}
}
