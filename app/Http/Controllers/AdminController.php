<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

use App\RekeningPenerimaan;
use App\StandarTarif;
use App\JenisPajak;
use App\User;
use App\Kecamatan;
use App\Desa;
use App\Tahun;

class AdminController extends Controller
{

    public function index(){
      return view('admin/admin_dashboard');
    }
    public function rekening_penerimaan(){
      $data['data']=RekeningPenerimaan::get();
      //dd($data['data']);
      return view('admin/admin_rekening',$data);
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
      //dd($request);
      $data['id']=$request['id'];

      $data['edit']=RekeningPenerimaan::where('id',$request['id'])->first();
      // dd($data['edit']);
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
      $data['edit']=StandarTarif::where('id',$request['id'])->first();
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

    public function kecamatan(){
      $data['data']=Kecamatan::get();

      return view('admin/admin_kecamatan',$data);
    }

    public function tahun(){
      $data['data']=Tahun::get();

      return view('admin/admin_tahun',$data);
    }

    public function desa(){
      $data['data']=Desa::get();

      return view('admin/admin_desa',$data);
    }


    public function tambahJenisPajak(){
      return view('admin/admin_tambah_jenis_pajak');
    }

    public function tambahKecamatan(){
      return view('admin/admin_tambah_kecamatan');
    }

    public function tambahTahun(){
      return view('admin/admin_tambah_tahun');
    }

    public function tambahDesa(){
      $data['kecamatan']=Kecamatan::get();
      return view('admin/admin_tambah_desa',$data);
    }

    public function insertJenisPajak(){
      $request=Input::all();
      $query=[
        "jenis"=>$request['namaJenisPajak']
      ];
      (!isset($request['id'])) ? JenisPajak::create($query) : JenisPajak::where('id',$request['id'])->update($query);

      return redirect('admin/pajak');

    }

    public function insertKecamatan(){
      $request=Input::all();
      $query=[
        "kecamatan"=>$request['namaKecamatan']
      ];
      (!isset($request['id'])) ? Kecamatan::create($query) : Kecamatan::where('id',$request['id'])->update($query);

      return redirect('admin/kecamatan');

    }

    public function insertTahun(){
      $request=Input::all();
      $query=[
        "tahun"=>$request['namaTahun']
      ];
      (!isset($request['id'])) ? Tahun::create($query) : Tahun::where('id',$request['id'])->update($query);

      return redirect('admin/tahun');

    }

    public function insertDesa(){
      $request=Input::all();
      $query=[
        "desa"=>$request['namaDesa'],
        "kecamatan_id"=>$request['kecamatan']
      ];
      (!isset($request['id'])) ? Desa::create($query) : Desa::where('id',$request['id'])->update($query);

      return redirect('admin/desa');

    }

    public function editJenisPajak(){
      $request=Input::all();
      $data['id']=$request['id'];
      $data['edit']=JenisPajak::where('id',$request['id'])->first();
      return view('admin/admin_tambah_jenis_pajak',$data);
    }

    public function editKecamatan(){
      $request=Input::all();
      $data['id']=$request['id'];
      $data['edit']=Kecamatan::where('id',$request['id'])->first();
      return view('admin/admin_tambah_kecamatan',$data);
    }

    public function editTahun(){
      $request=Input::all();
      $data['id']=$request['id'];
      $data['edit']=Tahun::where('id',$request['id'])->first();
      return view('admin/admin_tambah_tahun',$data);
    }

    public function editDesa(){
      $request=Input::all();
      $data['id']=$request['id'];
      $data['kecamatan']=Kecamatan::get();
      $data['edit']=Desa::where('id',$request['id'])->first();
      return view('admin/admin_tambah_desa',$data);
    }

    public function hapusJenisPajak(){
      $request=Input::all();
      $db=JenisPajak::where('id','=',$request['id'])->delete();
      return redirect('admin/pajak');
    }

    public function hapusKecamatan(){
      $request=Input::all();
      $db=Kecamatan::where('id','=',$request['id'])->delete();
      return redirect('admin/kecamatan');
    }
    public function hapusTahun(){
      $request=Input::all();
      $db=Tahun::where('id','=',$request['id'])->delete();
      return redirect('admin/tahun');
    }
    public function hapusDesa(){
      $request=Input::all();
      $db=Desa::where('id','=',$request['id'])->delete();
      return redirect('admin/desa');
    }

    public function pwd(){

      return view('admin/admin_pwd');
    }
    public function updatePwd(){
      $request=Input::all();
      // return $currentId=Auth::user()->id;
      User::where('id',Auth::user()->id)->update([
        "password"=>bcrypt($request['pwd'])
      ]);

      return redirect('admin/pwd');
    }
}
