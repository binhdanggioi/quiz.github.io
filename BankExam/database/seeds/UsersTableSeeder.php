<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        factory(User::class,500)->create();
        DB::table('users')->insert([
    [
        'name' => 'admin',
        'email' => 'admin@gmail.com',
        'phone' => '0364824343',
        'password' => bcrypt('123456'),
        'created_at' => now(),
        'updated_at' => now(),
        'email_verified_at' => now(),
    ],
    [
        'name' => 'user',
        'email' => 'user@gmail.com',
        'phone' => '0886214612',
        'password' => bcrypt('123456'),
        'created_at' => now(),
        'updated_at' => now(),
        'email_verified_at' => now(),
    ],
]);    }
}
