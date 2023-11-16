<?php

namespace Database\Seeders;

use App\Models\CompanyUser;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $proposalPermission = [
            'create proposal',
            'edit proposal',
            'delete proposal',
            'send proposal',
        ];

        $userPermission = [
            'create user',
            'edit user',
            'delete user',
            'assign user',
        ];

        $companyPermission = [
            'create company',
            'edit company',
            'delete company',
            'assign company',
        ];

        // create 1 permission array from the 3
        $permissionArray = array_merge($proposalPermission, $userPermission, $companyPermission);

        // create permissions
        foreach($permissionArray as $permission){
            Permission::create(['name' => $permission]);
        }

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'user']);
        $role1->givePermissionTo($proposalPermission);

        // create demo user
        $user = User::factory()->create([
            'name' => 'Example User',
            'email' => 'user@example.com',
        ]);
        $user->assignRole($role1);

        CompanyUser::create([
            'company_id' => 1,
            'user_id' => 1,
        ]);

        // create roles and assign existing permissions
        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo($proposalPermission);
        $role2->givePermissionTo($userPermission);

        // create demo user
        $user = User::factory()->create([
            'name' => 'Example Admin',
            'email' => 'admin@example.com',
        ]);
        $user->assignRole($role2);

        CompanyUser::create([
            'company_id' => 1,
            'user_id' => 2,
        ]);

        /**
         * gets all permissions via Gate::before rule
         * see AuthServiceProvider
         */
        $role3 = Role::create(['name' => 'super-admin']);

        // create demo user
        $user = User::factory()->create([
            'name' => 'Example Super-Admin',
            'email' => 'superadmin@example.com',
        ]);
        $user->assignRole($role3);

        CompanyUser::create([
            'company_id' => 1,
            'user_id' => 3,
        ]);
    }
}
