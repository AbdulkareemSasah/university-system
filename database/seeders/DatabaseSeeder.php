<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $role = Role::create([
            'guard_name' => 'web',
            'name' => 'Super User',
        ]);
        $role->permissions()->attach(Permission::all());
        $user = User::create([
            'name' => 'name',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole($role);
    }
}
