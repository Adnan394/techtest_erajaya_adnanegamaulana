<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $levels = [
            [
                'code'  => '1',
                'name'  => 'Staff'
            ],
            [
                'code'  => '2',
                'name'  => 'Supervisor'
            ],
            [
                'code'  => '3',
                'name'  => 'Asisstant Manager'
            ],
            [
                'code'  => '4',
                'name'  => 'Manager'
            ],
            [
                'code'  => '5',
                'name'  => 'General Manager'
            ],
            [
                'code'  => '6',
                'name'  => 'Director'
            ],
        ];

        foreach ($levels as $level) {
            Level::create([
                'level_code'     => $level['code'],
                'level_name'     => $level['name']
            ]);
        }
    }
}
