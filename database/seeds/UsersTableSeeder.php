<?php

use Illuminate\Database\Seeder;
use App\Models\Users\User;

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
            ['over_name' => '田中',
            'under_name' => '七郎',
            'over_name_kana' => 'タナカ',
            'under_name_kana' => 'シチロウ',
            'mail_address' => 'shichiro@com',
            'birth_day' => '20050615',
            'sex' => 01,
            'role' => 03,
            'password' => bcrypt('12345678')]
        ]);
    }
}
