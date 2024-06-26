<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permissions;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            // Permissions::create(
            //     [
            //         'created_at' => \Carbon\Carbon::now(),
            //         'updated_at' => \Carbon\Carbon::now(),
            //         'route_name' => 'Dashboard',
            //         'url' => 'dashboard',
            //         'permission_name' => 'Dashboard',
            //     ]);
            Permissions::create(
                [
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                    'route_name' => 'Amenities-Category',
                    'url' => 'list-amenities-category',
                    'permission_name' => 'Amenities-Category',
                ]);
            Permissions::create(
                [
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                    'route_name' => 'Gallery-Category',
                    'url' => 'list-gallery-category',
                    'permission_name' => 'Gallery-Category',
                ]);
            Permissions::create(
                [
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                    'route_name' => 'Role',
                    'url' => 'list-role',
                    'permission_name' => 'Role',
                ]);
            Permissions::create(
                [
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                    'route_name' => 'Icon',
                    'url' => 'list-icon',
                    'permission_name' => 'Icon',
                ]);
            Permissions::create(
                [
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                    'route_name' => 'About-Us',
                    'url' => 'list-aboutus',
                    'permission_name' => 'About-Us',
                ]);
            Permissions::create(
                [
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                    'route_name' => 'About-Us-Element',
                    'url' => 'list-aboutus-element',
                    'permission_name' => 'About-Us-Element',
                ]);
                Permissions::create(
                    [
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now(),
                        'route_name' => 'Tree',
                        'url' => 'list-tress',
                        'permission_name' => 'Tree',
                    ]);
                    Permissions::create(
                        [
                            'created_at' => \Carbon\Carbon::now(),
                            'updated_at' => \Carbon\Carbon::now(),
                            'route_name' => 'Plant',
                            'url' => 'list-flowers',
                            'permission_name' => 'Plant',
                        ]);
            Permissions::create(
                [
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                    'route_name' => 'Zone-Area',
                    'url' => 'list-zone-area',
                    'permission_name' => 'Zone-Area',
                ]);
            Permissions::create(
                [
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                    'route_name' => 'Amenities',
                    'url' => 'list-amenities',
                    'permission_name' => 'Amenities List',
                ]);
            Permissions::create(
                [
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                    'route_name' => 'Ticket',
                    'url' => 'list-ticket',
                    'permission_name' => 'Ticket',
                ]);
            Permissions::create(
                [
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                    'route_name' => 'Gallery',
                    'url' => 'list-gallery',
                    'permission_name' => 'Gallery',
                ]);
           
        


            
    }
}
