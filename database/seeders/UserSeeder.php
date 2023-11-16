<?php

namespace Database\Seeders;

use App\Models\CompanyUser;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create 50 users
        User::factory(50)
            ->create();

        /**
         * including the admin users we created in PermissionSeeder, we have 53 users
         * here we are assigning users to a company
         * we start x at 4 because the first 3 users have already been assigned to ServiceGuru in PermissionSeeder
         * */
        for ($x = 4; $x <= 53; $x++) {
            CompanyUser::create([
                'company_id' => random_int(2, 6),
                'user_id' => $x,
            ]);
        }
    }
}
