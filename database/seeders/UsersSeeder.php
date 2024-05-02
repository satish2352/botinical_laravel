<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'email' => 'admin@gmail.com',
                'mobile_number' => '9527090946',
                // 'u_uname' => 'admin@gmail.com',
                // 'password' => bcrypt('admin@gmail.com'),
                'role_id' => 1,
                'f_name' => 'fname',
                'm_name' => 'mname',
                'l_name' => 'lname',
                'gender' => 'female',
                'date_of_birth' => '04/02/2022',
                'address' => 'nashik',
                'occupation' => 'teacher',
                'ip_address' => '192.168.1.32',
            ]);
                    
                                
    }
}