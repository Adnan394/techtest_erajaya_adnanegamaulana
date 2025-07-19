<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genders = [
            [
                'code'  => 'L',
                'name'  => 'Laki-laki'
            ],
            [
                'code'  => 'P',
                'name'  => 'Perempuan'
            ]
        ];

        foreach ($genders as $gender) {
            Gender::create([
                'gender_code'     => $gender['code'],
                'gender_name'     => $gender['name']
            ]);
        }
    }
}
