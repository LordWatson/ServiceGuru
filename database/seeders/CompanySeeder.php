<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create ServiceGuru company
        Company::factory()->create([
            'name' => 'Service Guru',
            'registered_office' => '12 St Edwards Close, Shaftesbury, Dorset, SP7 8RJ',
            'parent_company' => 1,
        ]);

        // create some random companies
        Company::factory(4)
            ->create();

        // create a company with a parent company
        Company::factory()->create([
            'name' => fake()->company(),
            'registered_office' => fake()->address(),
            'parent_company' => 5,
        ]);
    }
}
