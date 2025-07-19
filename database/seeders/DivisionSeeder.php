<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $divisions = [
            [
                'code'  => 'DIV-001',
                'name'  => 'Human Capital'
            ],
            [
                'code'  => 'DIV-002',
                'name'  => 'Finance'
            ],
            [
                'code'  => 'DIV-003',
                'name'  => 'Operation'
            ],
            [
                'code'  => 'DIV-004',
                'name'  => 'IT'
            ],
            [
                'code'  => 'DIV-005',
                'name'  => 'Accounting'
            ],
            [
                'code'  => 'DIV-006',
                'name'  => 'Marketing'
            ],
        ];

        foreach ($divisions as $division) {
            Division::create([
                'division_code'     => $division['code'],
                'division_name'     => $division['name']
            ]);
        }
    }
}
