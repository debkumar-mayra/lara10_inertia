<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $UserTypes=['SUPER-ADMIN','VENDOR','USER'];
        foreach ($UserTypes as $UserType) {
            Role::create(['name' => $UserType]);
        }

    }
}
