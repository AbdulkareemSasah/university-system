<?php

namespace Database\Seeders;

use App\Models\Collage;
use App\Models\Department;
use App\Models\Team;
use App\Models\Term;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Year;
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
        $year = factory(Year::class , 6)->make([
            "name" => str(fake()->numberBetween(2024,2030))
        ]);
        $term = factory(Term::class, 2)->make()->
        $year->terms()->attach($term);
        $collage = Collage::create([
            "name" => "كلية الهندسة وتقنية المعلومات"
        ]);
        $department = Department::create([
            "name" => "علوم الحاسب"
        ]);
        $collage->departments()->attach($department);
    }
}
