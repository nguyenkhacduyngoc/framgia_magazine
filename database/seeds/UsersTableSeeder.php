<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'nguyenkhac.duyngoc',
            'fullname' => 'Nguyen Khac Duy Ngoc',
            'email' => 'nguyenkhacduyngoc@gmail.com',
            'role' => '1',
            'password' => bcrypt('ngoc123456'),
            'gender' => 'male',
        ]);
    }
}
