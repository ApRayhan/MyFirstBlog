<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RollsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rolls')->insert([
        	'name' => 'Admin',
        	'slug' => 'admin'
        ]);
        DB::table('rolls')->insert([
        	'name' => 'Author',
        	'slug' => 'author'
        ]);
    }
}
