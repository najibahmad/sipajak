<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;

use App\Pegawai;

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

      return view('penanggungJawab/penanggung_jawab_tambah_pegawai');
    }
    public function insertPegawai(){
      return redirect('penanggungJawab/pegawai');
    }
    public function hapusPegawai(){
      return redirect('penanggungJawab/pegawai');
    }
}
