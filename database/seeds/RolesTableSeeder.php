<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Заполнение таблицы Roles
        DB::table('roles')->insert([
            'role' => 'user'
        ]);
    }
}
