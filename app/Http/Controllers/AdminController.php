<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;

use App\RekeningPenerimaan;
use App\StandarTarif;
use App\JenisPajak;

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

      $db=RekeningPenerimaan::create([
        "nomor_rekening"=>$request['nomorRekening'],
        "uraian"=>$request['uraian']
      ]);
      // return $request;
      return redirect('admin/rekening');
    }
    public function editRekening(){
      return view('admin/admin_edit_rekening');
    }
    public function hapusRekening(){
      $request=Input::all();

      $result=RekeningPenerimaan::where('id','=',$request['id'])->delete();

      return redirect('admin/rekening');
    }
    public function tarif(){
      $result['data']=StandarTarif::join('jenis_pajak','jenis_pajak.id','=','standar_tarif.jenis_pajak_id')->get();

      // return $result;
      return view('admin/admin_tarif',$result);
    }
    public function tambahTarifPajak(){
      $result['jenisPajak']=JenisPajak::get();

      return view('admin/admin_tambah_tarif_pajak',$result);
    }
    public function insertTarifPajak(){
      $request=Input::all();

      $db=StandarTarif::create([
        "nama_item"=>$request['namaItem'],
        "jenis_pajak_id"=>$request['jenisPajakId'],
        "satuan"=>$request['satuan'],
        "tarif"=>$request['tarif'],
        "tahun"=>$request['tahun']
      ]);
      return redirect('admin/tarif');
    }
    public function editTarifPajak(){
      return view('admin/admin_edit_tarif_pajak');
    }
    public function hapusTarifPajak(){
      $request=Input::all();

      $result=StandarTarif::where('id','=',$request['id'])->delete();
      // return $request;
      return redirect('admin/tarif');
    }
    public function pajak(){
      return view('admin/admin_pajak');
    }
    public function tambahJenisPajak(){
      return view('admin/admin_tambah_jenis_pajak');
    }
    public function editJenisPajak(){
      return view('admin/admin_edit_jenis_pajak');
    }
    public function hapusJenisPajak(){
      return redirect('admin/admin_pajak');
    }
    public function pwd(){
      return view('admin/admin_pwd');
    }
}
