<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\users;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data =
        [
            ['name'=>'Administrator','role_id'=>'1','email'=>'admin@gmail.com','password'=>bcrypt('000000')],


        ];
        DB::table('users')->insert($data);
    }
}
