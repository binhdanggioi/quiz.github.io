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
            'name' => 'What is Laravel',
            'email' => 'admin@admin.com',
            'phone' =>'(241) 852-9103',
            'email_verified_at' => null,
            'password' => bcrypt('123456'),
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
    }
}
