<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = [
            [
                'code'  => 'COMP-001',
                'name'  => 'PT Erajaya Swasembada'
            ],
            [
                'code'  => 'COMP-002',
                'name'  => 'PT Erafone Artha Retailindo'
            ],
            [
                'code'  => 'COMP-003',
                'name'  => 'PT Nusa Abadi Sukses Artha'
            ],
            [
                'code'  => 'COMP-004',
                'name'  => 'PT Data Citra Mandiri'
            ],
            [
                'code'  => 'COMP-005',
                'name'  => 'PT JDSport Fashion Indonesia'
            ],
            [
                'code'  => 'COMP-006',
                'name'  => 'PT Sinar Eka Selaras'
            ],
        ];

        foreach ($companies as $company) {
            Company::create([
                'company_code'     => $company['code'],
                'company_name'     => $company['name']
            ]);
        }
    }
}
