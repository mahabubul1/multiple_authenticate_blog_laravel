<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("roles")->insert([
            "name"=>"admin",
            "slug"=>"admin",
        ]);

        DB::table("roles")->insert([
            "name"=>"author",
            "slug"=>"author",
        ]);

    }
}
