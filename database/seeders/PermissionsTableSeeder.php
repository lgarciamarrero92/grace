<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'key' => 'browse_admin',
                'table_name' => NULL,
                'created_at' => '2021-01-05 00:12:49',
                'updated_at' => '2021-01-05 00:12:49',
            ),
            1 => 
            array (
                'id' => 2,
                'key' => 'browse_bread',
                'table_name' => NULL,
                'created_at' => '2021-01-05 00:12:49',
                'updated_at' => '2021-01-05 00:12:49',
            ),
            2 => 
            array (
                'id' => 3,
                'key' => 'browse_database',
                'table_name' => NULL,
                'created_at' => '2021-01-05 00:12:49',
                'updated_at' => '2021-01-05 00:12:49',
            ),
            3 => 
            array (
                'id' => 4,
                'key' => 'browse_media',
                'table_name' => NULL,
                'created_at' => '2021-01-05 00:12:49',
                'updated_at' => '2021-01-05 00:12:49',
            ),
            4 => 
            array (
                'id' => 5,
                'key' => 'browse_compass',
                'table_name' => NULL,
                'created_at' => '2021-01-05 00:12:49',
                'updated_at' => '2021-01-05 00:12:49',
            ),
            5 => 
            array (
                'id' => 6,
                'key' => 'browse_menus',
                'table_name' => 'menus',
                'created_at' => '2021-01-05 00:12:49',
                'updated_at' => '2021-01-05 00:12:49',
            ),
            6 => 
            array (
                'id' => 7,
                'key' => 'read_menus',
                'table_name' => 'menus',
                'created_at' => '2021-01-05 00:12:49',
                'updated_at' => '2021-01-05 00:12:49',
            ),
            7 => 
            array (
                'id' => 8,
                'key' => 'edit_menus',
                'table_name' => 'menus',
                'created_at' => '2021-01-05 00:12:49',
                'updated_at' => '2021-01-05 00:12:49',
            ),
            8 => 
            array (
                'id' => 9,
                'key' => 'add_menus',
                'table_name' => 'menus',
                'created_at' => '2021-01-05 00:12:49',
                'updated_at' => '2021-01-05 00:12:49',
            ),
            9 => 
            array (
                'id' => 10,
                'key' => 'delete_menus',
                'table_name' => 'menus',
                'created_at' => '2021-01-05 00:12:49',
                'updated_at' => '2021-01-05 00:12:49',
            ),
            10 => 
            array (
                'id' => 11,
                'key' => 'browse_roles',
                'table_name' => 'roles',
                'created_at' => '2021-01-05 00:12:49',
                'updated_at' => '2021-01-05 00:12:49',
            ),
            11 => 
            array (
                'id' => 12,
                'key' => 'read_roles',
                'table_name' => 'roles',
                'created_at' => '2021-01-05 00:12:49',
                'updated_at' => '2021-01-05 00:12:49',
            ),
            12 => 
            array (
                'id' => 13,
                'key' => 'edit_roles',
                'table_name' => 'roles',
                'created_at' => '2021-01-05 00:12:49',
                'updated_at' => '2021-01-05 00:12:49',
            ),
            13 => 
            array (
                'id' => 14,
                'key' => 'add_roles',
                'table_name' => 'roles',
                'created_at' => '2021-01-05 00:12:49',
                'updated_at' => '2021-01-05 00:12:49',
            ),
            14 => 
            array (
                'id' => 15,
                'key' => 'delete_roles',
                'table_name' => 'roles',
                'created_at' => '2021-01-05 00:12:49',
                'updated_at' => '2021-01-05 00:12:49',
            ),
            15 => 
            array (
                'id' => 16,
                'key' => 'browse_users',
                'table_name' => 'users',
                'created_at' => '2021-01-05 00:12:49',
                'updated_at' => '2021-01-05 00:12:49',
            ),
            16 => 
            array (
                'id' => 17,
                'key' => 'read_users',
                'table_name' => 'users',
                'created_at' => '2021-01-05 00:12:49',
                'updated_at' => '2021-01-05 00:12:49',
            ),
            17 => 
            array (
                'id' => 18,
                'key' => 'edit_users',
                'table_name' => 'users',
                'created_at' => '2021-01-05 00:12:49',
                'updated_at' => '2021-01-05 00:12:49',
            ),
            18 => 
            array (
                'id' => 19,
                'key' => 'add_users',
                'table_name' => 'users',
                'created_at' => '2021-01-05 00:12:49',
                'updated_at' => '2021-01-05 00:12:49',
            ),
            19 => 
            array (
                'id' => 20,
                'key' => 'delete_users',
                'table_name' => 'users',
                'created_at' => '2021-01-05 00:12:49',
                'updated_at' => '2021-01-05 00:12:49',
            ),
            20 => 
            array (
                'id' => 21,
                'key' => 'browse_settings',
                'table_name' => 'settings',
                'created_at' => '2021-01-05 00:12:49',
                'updated_at' => '2021-01-05 00:12:49',
            ),
            21 => 
            array (
                'id' => 22,
                'key' => 'read_settings',
                'table_name' => 'settings',
                'created_at' => '2021-01-05 00:12:49',
                'updated_at' => '2021-01-05 00:12:49',
            ),
            22 => 
            array (
                'id' => 23,
                'key' => 'edit_settings',
                'table_name' => 'settings',
                'created_at' => '2021-01-05 00:12:49',
                'updated_at' => '2021-01-05 00:12:49',
            ),
            23 => 
            array (
                'id' => 24,
                'key' => 'add_settings',
                'table_name' => 'settings',
                'created_at' => '2021-01-05 00:12:49',
                'updated_at' => '2021-01-05 00:12:49',
            ),
            24 => 
            array (
                'id' => 25,
                'key' => 'delete_settings',
                'table_name' => 'settings',
                'created_at' => '2021-01-05 00:12:49',
                'updated_at' => '2021-01-05 00:12:49',
            ),
            25 => 
            array (
                'id' => 26,
                'key' => 'browse_hooks',
                'table_name' => NULL,
                'created_at' => '2021-01-05 00:12:49',
                'updated_at' => '2021-01-05 00:12:49',
            ),
            26 => 
            array (
                'id' => 27,
                'key' => 'browse_categories',
                'table_name' => 'categories',
                'created_at' => '2021-01-05 00:16:52',
                'updated_at' => '2021-01-05 00:16:52',
            ),
            27 => 
            array (
                'id' => 28,
                'key' => 'read_categories',
                'table_name' => 'categories',
                'created_at' => '2021-01-05 00:16:52',
                'updated_at' => '2021-01-05 00:16:52',
            ),
            28 => 
            array (
                'id' => 29,
                'key' => 'edit_categories',
                'table_name' => 'categories',
                'created_at' => '2021-01-05 00:16:52',
                'updated_at' => '2021-01-05 00:16:52',
            ),
            29 => 
            array (
                'id' => 30,
                'key' => 'add_categories',
                'table_name' => 'categories',
                'created_at' => '2021-01-05 00:16:52',
                'updated_at' => '2021-01-05 00:16:52',
            ),
            30 => 
            array (
                'id' => 31,
                'key' => 'delete_categories',
                'table_name' => 'categories',
                'created_at' => '2021-01-05 00:16:52',
                'updated_at' => '2021-01-05 00:16:52',
            ),
            31 => 
            array (
                'id' => 32,
                'key' => 'browse_data_inputs',
                'table_name' => 'data_inputs',
                'created_at' => '2021-01-05 00:24:33',
                'updated_at' => '2021-01-05 00:24:33',
            ),
            32 => 
            array (
                'id' => 33,
                'key' => 'read_data_inputs',
                'table_name' => 'data_inputs',
                'created_at' => '2021-01-05 00:24:33',
                'updated_at' => '2021-01-05 00:24:33',
            ),
            33 => 
            array (
                'id' => 34,
                'key' => 'edit_data_inputs',
                'table_name' => 'data_inputs',
                'created_at' => '2021-01-05 00:24:33',
                'updated_at' => '2021-01-05 00:24:33',
            ),
            34 => 
            array (
                'id' => 35,
                'key' => 'add_data_inputs',
                'table_name' => 'data_inputs',
                'created_at' => '2021-01-05 00:24:33',
                'updated_at' => '2021-01-05 00:24:33',
            ),
            35 => 
            array (
                'id' => 36,
                'key' => 'delete_data_inputs',
                'table_name' => 'data_inputs',
                'created_at' => '2021-01-05 00:24:33',
                'updated_at' => '2021-01-05 00:24:33',
            ),
        ));
        
        
    }
}