<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;

use App\RekeningPenerimaan;
use App\StandarTarif;
use App\JenisPajak;
use Auth;

class AdminController extends Controller
{

    public function index(){
      return view('admin/admin_dashboard');
    }
    public function rekening_penerimaan(){
      $result['data']=RekeningPenerimaan::get();

      return view('admin/admin_rekening',$result);
    }

    public function tambahRekening(){
      return view('admin/admin_tambah_rekening');
    }

    public function insertRekening(){
      $request=Input::all();

      (!isset($request['id'])) ? RekeningPenerimaan::create([
        "nomor_rekening"=>$request['nomorRekening'],
        "uraian"=>$request['uraian']
      ]) : RekeningPenerimaan::where("id",$request['id'])->update([
        "nomor_rekening"=>$request['nomorRekening'],
        "uraian"=>$request['uraian']
      ]);
      // return $request;
      return redirect('admin/rekening');
    }

    public function editRekening(){
      $request=Input::all();
      $data['id']=$request['id'];
      return view('admin/admin_tambah_rekening',$data);
    }

    public function hapusRekening(){
      $request=Input::all();

      $result=RekeningPenerimaan::where('id','=',$request['id'])->delete();

      return redirect('admin/rekening');
    }

    public function tarif(){
       $result['data']=StandarTarif::join('jenis_pajak','jenis_pajak.id','=','standar_tarif.jenis_pajak_id')->select('standar_tarif.*','jenis_pajak.*','standar_tarif.id as id')->get();

      // dd($result['data']);
      // return $result;
      return view('admin/admin_tarif',$result);
    }
    public function getStandarTarif(){
      $request=Input::all();
      $data=StandarTarif::join('jenis_pajak','jenis_pajak.id','=','standar_tarif.jenis_pajak_id')->where('tahun',$request['tahun'])->select('standar_tarif.*','jenis_pajak.*','standar_tarif.id as id')->get();

      return Response::json($data);
    }

    public function tambahTarifPajak(){
      $data['jenisPajak']=JenisPajak::get();

      return view('admin/admin_tambah_tarif_pajak',$data);
    }

    public function insertTarifPajak(){
      $request=Input::all();

      $query=[
        "nama_item"=>$request['namaItem'],
        "jenis_pajak_id"=>$request['jenisPajakId'],
        "satuan"=>$request['satuan'],
        "tarif"=>$request['tarif'],
        "tahun"=>$request['tahun']
      ];
      (!isset($request['id'])) ? $data=StandarTarif::create($query) : $data=StandarTarif::where('id',$request['id'])->update($query);

      // dd($data);
      return redirect('admin/tarif');
    }

    public function editTarifPajak(){
      $request=Input::all();
      $data['id']=$request['id'];
      $data['jenisPajak']=JenisPajak::get();
      return view('admin/admin_tambah_tarif_pajak',$data);
    }

    public function hapusTarifPajak(){
      $request=Input::all();

      $result=StandarTarif::where('id','=',$request['id'])->delete();
      // return $request;
      return redirect('admin/tarif');
    }
    public function pajak(){
      $data['data']=JenisPajak::get();

      return view('admin/admin_pajak',$data);
    }
    public function tambahJenisPajak(){
      return view('admin/admin_tambah_jenis_pajak');
    }
    public function insertJenisPajak(){
      $request=Input::all();
      $query=[
        "jenis"=>$request['namaJenisPajak']
      ];
      (!isset($request['id'])) ? JenisPajak::create($query) : JenisPajak::where('id',$request['id'])->update($query);

      return redirect('admin/pajak');

    }
    public function editJenisPajak(){
      $request=Input::all();
      $data['id']=$request['id'];
      return view('admin/admin_tambah_jenis_pajak',$data);
    }
    public function hapusJenisPajak(){
      $request=Input::all();
      $db=JenisPajak::where('id','=',$request['id'])->delete();
      return redirect('admin/pajak');
    }
    public function pwd(){
      return view('admin/admin_pwd');
    }
}
