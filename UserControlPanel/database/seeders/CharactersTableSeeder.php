<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Characters;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;


class CharactersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $connection = DB::connection('gs_data');

        $connection->table('characters')->insert([
            [
                'charactername' => 'John_Smith',
                'account' => 1,
                'x' => 100.000001,
                'y' => 200.000002,
                'z' => 300.000003,
                'health' => 100,
                'armor' => 50,
                'last_login_time' => now()->subDays(1),
                'hunger' => 80,
                'thirst' => 90,
                'adminnick' => 'Ismeretlen',
                'dimension_id' => 0,
                'money' => 5000000000,
                'pp' => 100,
                'skin_id' => 1,
                'age' => 30,
                'maxvehs' => 2,
                'maxinteriors' => 1,
                'petID' => null,
                'chatblock' => json_encode(['reason' => 'None', 'time' => '']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'charactername' => 'Jane_Doe',
                'account' => 2,
                'x' => 150.000001,
                'y' => 250.000002,
                'z' => 350.000003,
                'health' => 90,
                'armor' => 45,
                'last_login_time' => now()->subHours(10),
                'hunger' => 70,
                'thirst' => 85,
                'adminnick' => 'Unknown',
                'dimension_id' => 1,
                'money' => 3000000000,
                'pp' => 95,
                'skin_id' => 2,
                'age' => 28,
                'maxvehs' => 3,
                'maxinteriors' => 2,
                'petID' => null,
                'chatblock' => json_encode(['reason' => 'Spam', 'time' => '2024-04-01T12:00:00Z']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'charactername' => 'Alice_Wonder',
                'account' => 3,
                'x' => 200.000001,
                'y' => 300.000002,
                'z' => 400.000003,
                'health' => 85,
                'armor' => 40,
                'last_login_time' => now()->subWeeks(2),
                'hunger' => 60,
                'thirst' => 80,
                'adminnick' => 'Admin123',
                'dimension_id' => 2,
                'money' => 2000000000,
                'pp' => 90,
                'skin_id' => 3,
                'age' => 26,
                'maxvehs' => 4,
                'maxinteriors' => 3,
                'petID' => null,
                'chatblock' => json_encode(['reason' => 'Griefing', 'time' => '2024-03-15T15:00:00Z']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
