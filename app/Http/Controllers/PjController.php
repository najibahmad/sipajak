<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

use App\Pegawai;
use App\User;
use App\roles;

class PjController extends Controller
{
    public function index(){
      return view('penanggungJawab/penanggung_jawab_dashboard');
    }
    public function pegawai(){
      $data['pegawai']=Pegawai::join('users','pegawai.user_id','=','users.id')->join('roles','roles.id','=','users.role_id')->get();
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
        "password"=>bcrypt($request['password'])
        //"password"=>bcrypt('654321')
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
      $request=Input::all();
      $db=User::where('id','=',$request['id'])->delete();

      return redirect('penanggungJawab/pegawai');
    }
    public function editPegawai(){
      $request=Input::all();
      // dd($request);
      $data['user_id']=$request['id'];
      $data['edit']=Pegawai::join('users','pegawai.user_id','=','users.id')
                    ->join('roles','users.role_id','=','roles.id')
                    ->where('pegawai.user_id',$request['id'])
                    ->first();
                    // dd($data['edit']);
      $data['roles']=roles::get();
      $data['pegawai']=Pegawai::join('users','pegawai.user_id','=','users.id')->join('roles','roles.id','=','users.role_id')->get();

      return view('penanggungJawab/penanggung_jawab_form_edit_pegawai',$data);
    }
    public function insertEditedPegawai(){
      $request=Input::all();
      

      if($request['password']!=""){
        $user=User::where('id','=',$request['user_id'])->update([
          "role_id"=>$request['grup'],
          "name"=>$request['name'],
          "email"=>$request['email'],
          "password"=>bcrypt($request['password'])
        ]);  
      }else{
        $user=User::where('id','=',$request['user_id'])->update([
          "role_id"=>$request['grup'],
          "name"=>$request['name'],
          "email"=>$request['email']
        ]);
      }
      

      $pegawai=Pegawai::where('user_id','=',$request['user_id'])->update([
        "nama"=>$request['name'],
        "nip"=>$request['NIP'],
        "alamat"=>$request['alamat'],
        "hp"=>$request['HP'],
        "status"=>$request['status'],
        "nomor_sk"=>$request['nomorSK']
      ]);

      return redirect('penanggungJawab/pegawai');
    }
    public function pwd(){

      return view('penanggungJawab/penanggung_jawab_pwd');
    }
    public function updatePwd(){
      $request=Input::all();
      // return $currentId=Auth::user()->id;
      User::where('id',Auth::user()->id)->update([
        "password"=>bcrypt($request['pwd'])
      ]);

      return redirect('penanggungJawab/pwd');
    }

}
