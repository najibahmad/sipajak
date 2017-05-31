<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

use App\WajibPajak;
use App\Desa;
use App\Kecamatan;
use App\KetetapanPajak;
use App\RekeningPenerimaan;
use App\JenisPajak;
use App\ItemKetetapanPajak;
use App\User;

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
      // $data['ketetapanPajak']=WajibPajak::join('ketetapan_pajak','wajib_pajak.id','ketetapan_pajak.wajib_pajak_id')->join('jenis_pajak','ketetapan_pajak.jenis_pajak_id','jenis_pajak.id')->get();
      $data['itemKetetapanPajak']=
          ItemKetetapanPajak::join('ketetapan_pajak','item_ketetapan_pajak.ketetapan_pajak_id','ketetapan_pajak.id')
                              ->join('wajib_pajak','wajib_pajak.id','ketetapan_pajak.wajib_pajak_id')
                              ->join('jenis_pajak','ketetapan_pajak.jenis_pajak_id','jenis_pajak.id')
                              ->whereIn('status_verifikasi',[1,0])
                              ->select('ketetapan_pajak.*','wajib_pajak.*','jenis_pajak.*','item_ketetapan_pajak.*','item_ketetapan_pajak.id as idikp')->get();
                              //dd($data);
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
    public function editKetetapanPajak(){
      $request=Input::all();

      $data['id']=$request['id'];
      $data['kecamatan']=Kecamatan::get();
      $data['desa']=Desa::get();
      $data['rekening']=RekeningPenerimaan::get();
      $data['jenisPajak']=JenisPajak::get();

      // return $data['rekening'];
      return view('operator/operator_tambah_ketetapan_pajak',$data);
    }
    public function insertKetetapanPajak(){
      $request=Input::all();
      // $a=2;
      // return $request['volume'.$a];

      $query1=[
        "bulan"=>$request['bulan'],
        "tahun"=>$request['tahun'],
        "jatuh_tempo"=>$request['jatuhTempo'],
        "nama_pekerjaan"=>$request['namaKegiatan'],
        "keterangan_pekerjaan"=>$request['keteranganKegiatan'],
        "wajib_pajak_id"=>$request['wajibPajakId'],
        "rekening_penerimaan_id"=>$request['kodeRekening'],
        "jenis_pajak_id"=>$request['jenisPajak']
      ];

      (!isset($request['id'])) ? $ketetapanPajak=KetetapanPajak::create($query1) : $ketetapanPajak=KetetapanPajak::where('id',$request['id'])->update($query1);

      if(!isset($request['id'])){
        for ($i=1; $i <= $request['totalItem'] ; $i++) {
          ItemKetetapanPajak::create([
            "nama_item"=>$request['namaItem'.$i],
            "volume"=>$request['volume'.$i],
            "satuan"=>$request['satuan'.$i],
            "harga"=>$request['harga'.$i],
            "ketetapan_pajak_id"=> $ketetapanPajak->id
          ]);
        }
      } else {
        ItemKetetapanPajak::where('id',$request['id'])->update([
          "nama_item"=>$request['namaItem'],
          "volume"=>$request['volume'],
          "satuan"=>$request['satuan'],
          "harga"=>$request['harga'],
          "ketetapan_pajak_id"=> $request['id']
        ]);
      }

      // (!isset($request['id'])) ?
      //
      // :
      //

      return redirect('operator/ketetapanPajak');
    }
    public function hapusKetetapanPajak(){
      $request=Input::all();

      ItemKetetapanPajak::where('id',$request['id'])->delete();

      return redirect('operator/ketetapanPajak');
    }
    public function statusVerifikasi(){
      $request=Input::all();
      //dd($request);

      ItemKetetapanPajak::where('id',$request['id'])->update([
        "status_verifikasi"=>1
      ]);

      return redirect('operator/ketetapanPajak');
    }
    public function getDesa(){
      $request=Input::all();

      $data=Desa::where('kecamatan_id',$request['id'])->get();

      return Response::json($data);
    }
    public function getNPWP(){
      $request=Input::all();

      $data=WajibPajak::where('npwp','like','%'.$request['npwp'].'%')->get();
      //dd("masuk");

      return Response::json($data);
    }
    public function getDataWajibPajak(){
      $request=Input::all();

      $data=WajibPajak::where('npwp',$request['npwp'])->first();

      return Response::json($data);
    }
    public function getDataKetetapanPajak(){
      $request=Input::all();

      //dd("masuuk");

      $data=ItemKetetapanPajak::join('ketetapan_pajak','item_ketetapan_pajak.ketetapan_pajak_id','ketetapan_pajak.id')
      ->join('wajib_pajak','wajib_pajak.id','ketetapan_pajak.wajib_pajak_id')
      ->join('jenis_pajak','ketetapan_pajak.jenis_pajak_id','jenis_pajak.id')
      ->where('npwp','like','%'.$request['npwp'].'%')
      ->whereIn('status_verifikasi',[1,0])->get();

      //dd($data);

      return Response::json($data);
    }
    public function pwd(){
      return view('operator/operator_pwd');
    }

    public function updatePwd(){
      $request=Input::all();
      // return $currentId=Auth::user()->id;
      User::where('id',Auth::user()->id)->update([
        "password"=>bcrypt($request['pwd'])
      ]);

      return redirect('operator/pwd');
    }
}
