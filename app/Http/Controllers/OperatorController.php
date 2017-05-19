<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;

use App\WajibPajak;
use App\Desa;
use App\Kecamatan;
use App\KetetapanPajak;
use App\RekeningPenerimaan;
use App\JenisPajak;

class OperatorController extends Controller
{
    public function index(){
      return view('operator/operator_dashboard');
    }
    public function wajibPajak(){
      $data['data']=WajibPajak::join('desa','desa.id','=','wajib_pajak.desa_id')->join('kecamatan','desa.kecamatan_id','=','kecamatan.id')->select('wajib_pajak.*','kecamatan.*','desa.*','wajib_pajak.id as id')->get();

      // return $data;
      return view('operator/operator_wajib_pajak',$data);
    }
    public function tambahWajibPajak(){
      $data['kecamatan']=Kecamatan::get();
      $data['desa']=Desa::get();
      return view('operator/operator_tambah_wajib_pajak',$data);
    }
    public function editWajibPajak(){
      $request=Input::all();

      $data['id']=$request['id'];
      $data['kecamatan']=Kecamatan::get();
      $data['desa']=Desa::get();
      return view('operator/operator_tambah_wajib_pajak',$data);
    }
    public function insertWajibPajak(){
      $request=Input::all();

      $query=[
        "nama"=>$request['nama'],
        "npwp"=>$request['NPWP'],
        "alamat"=>$request['alamat'],
        "jatuh_tempo"=>$request['jatuhTempo'],
        "desa_id"=>$request['desa']
      ];

      (!isset($request['id'])) ? WajibPajak::create($query) : WajibPajak::where('id',$request['id'])->update($query);



      return redirect('operator/wajibPajak');
    }
    public function hapusWajibPajak(){
      $request=Input::all();
      $db=WajibPajak::where('id','=',$request['id'])->delete();
      // return $request;
      return redirect('operator/wajibPajak');
    }
    public function ketetapanPajak(){
      $data['ketetapanPajak']=KetetapanPajak::get();
      return view('operator/operator_ketetapan_pajak',$data);
    }
    public function tambahKetetapanPajak(){
      $data['kecamatan']=Kecamatan::get();
      $data['desa']=Desa::get();
      $data['rekening']=RekeningPenerimaan::get();
      $data['jenisPajak']=JenisPajak::get();

      // return $data['rekening'];
      return view('operator/operator_tambah_ketetapan_pajak',$data);
    }
    public function insertKetetapanPajak(){
      $request=Input::all();

      // $db=KetetapanPajak::create([
      //   "bulan"=>$request['bulan'],
      //   "tahun"=>$request['tahun'],
      //   "jatuh_tempo"=>$request['jatuhTempo'],
      //   "nama_pekerjaan"=>$request['namaKegiatan'],
      //   "keterangan"=>$request['keteranganKegiatan'],
      //   "wajib_pajak_id"=>,
      //   "rekening_penerimaan_id"=>$request['kodeRekening'],
      //   "jenis_pajak_id"=>$request['jenisPajak']
      //
      // ]);

      return redirect('operator/ketetapanPajak');
    }
    public function getDesa(){
      $request=Input::all();

      $data=Desa::where('kecamatan_id',$request['id'])->get();

      return Response::json($data);
    }
    public function pwd(){
      return view('operator/operator_pwd');
    }
}
