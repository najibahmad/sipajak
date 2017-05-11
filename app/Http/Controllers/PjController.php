<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;

use App\Pegawai;
use App\User;
use App\roles;

class PjController extends Controller
{
    public function index(){
      return view('penanggungJawab/penanggung_jawab_dashboard');
    }
    public function pegawai(){
      $data['pegawai']=Pegawai::get();
      return view('penanggungJawab/penanggung_jawab_pegawai',$data);
    }
    public function tambahPegawai(){
      $data['roles']=roles::get();

      return view('penanggungJawab/penanggung_jawab_tambah_pegawai',$data);
    }
    public function insertPegawai(){
      $request=Input::all();

      $user=User::create([
        "role_id"=>$request['grup'],
        "name"=>$request['name'],
        "email"=>$request['email'],
        "password"=>$request['name']
      ]);

      $lastUser=User::orderBy('id','desc')->first();

      $pegawai=Pegawai::create([
        "user_id"=>$lastUser['id'],
        "nama"=>$request['name'],
        "nip"=>$request['NIP'],
        "alamat"=>$request['alamat'],
        "hp"=>$request['HP'],
        "status"=>$request['status'],
        "nomor_sk"=>$request['nomorSK']
      ]);

      return redirect('penanggungJawab/pegawai');
    }
    public function hapusPegawai(){
      return redirect('penanggungJawab/pegawai');
    }
}
