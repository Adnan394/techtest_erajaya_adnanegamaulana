<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\EmployeePeriod;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        
        for ($i=0; $i < 100; $i++) {
            $employee = Employee::create([
                'employee_number'   => $faker->numberBetween(100000, 200000),
                'employee_name'     => $faker->name,
                'employee_address'  => $faker->address
            ]);

            $employee_level_id = rand(1, 6);
            $employee_gender_id = rand(1, 6);

            for ($j=1; $j < 13 ; $j++) {
                EmployeePeriod::create([
                    'employee_id'   => $employee->id,
                    'division_id'   => rand(1, 6),
                    'company_id'    => rand(1, 6),
                    'gender_id'     => $employee_gender_id,
                    'level_id'      => $employee_level_id,
                    'period'        => '2024'.str_pad($j, 2, '0', STR_PAD_LEFT)
                ]);
            }
        }
    }
}
