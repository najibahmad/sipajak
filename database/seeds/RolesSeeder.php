<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\roles;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin=new roles;
        $admin->id="1";
        $admin->description="admin";
        $admin->save();

        $penanggung_jawab=new roles;
        $penanggung_jawab->id="2";
        $penanggung_jawab->description="penanggung_jawab";
        $penanggung_jawab->save();

        $bendahara=new roles;
        $bendahara->id="3";
        $bendahara->description="bendahara";
        $bendahara->save();

        $operator=new roles;
        $operator->id="4";
        $operator->description="operator";
        $operator->save();

        $verifikator=new roles;
        $verifikator->id="5";
        $verifikator->description="verifikator";
        $verifikator->save();
    }
}
