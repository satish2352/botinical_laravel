<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Roles;
class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            Roles::create(
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'role_name' => 'Admin',
            ]);
            Roles::create(
                [
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                    'role_name' => 'Driver/Garden Guide',
                ]);
            Roles::create(
                [
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                    'role_name' => 'User/Customer',
                ]);
               

           
    }
}
