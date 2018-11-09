<?php

use Illuminate\Database\Seeder;
use App\Roles;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = new App\Roles;
        $role_teacher = new App\Roles;
        $role_student = new App\Roles;

        $role_admin->name = "admin";
        $role_admin->save();

        $role_teacher->name = "teacher";
        $role_teacher->save();

        $role_student->name = "student";
        $role_student->save();
    }
}
