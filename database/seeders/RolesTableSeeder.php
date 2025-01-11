<?php

namespace Database\Seeders;

use App\Models\Role;
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
                'title' => 'Lab',
            ],
            [
                'id'    => 3,
                'title' => 'Patient',
            ],
            [
                'id'    => 4,
                'title' => 'Doctor',
            ],
            [
                'id'    => 5,
                'title' => 'Hospital',
            ],
        ];

        Role::insert($roles);
    }
}
