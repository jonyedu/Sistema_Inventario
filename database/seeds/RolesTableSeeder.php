<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'id'    => 1,
                'title' => 'Admin',
            ],
            [
                'id'    => 2,
                'title' => 'Jefe de P&C',
            ],
            [
                'id'    => 3,
                'title' => 'Asistente de P&C',
            ],
            [
                'id'    => 4,
                'title' => 'Jefe de Bodegas',
            ],
        ];

        Role::insert($roles);

    }
}
