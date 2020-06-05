<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
			['name' => 'insert_exam'],
			['name' => 'update_exam'],
			['name' => 'delete_exam'],
			['name' => 'insert_question'],
			['name' => 'update_question'],
			['name' => 'delete_question'],
			['name' => 'check_result'],
			['name' => 'exam_online'],
		]);
    }
}
