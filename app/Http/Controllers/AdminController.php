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
use App\WajibPajak;
use App\ItemKetetapanPajak;
use App\KetetapanPajak;

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
      $data['jenis_pajak']=JenisPajak::get();
      return view('admin/admin_tambah_rekening',$data);
    }

    public function insertRekening(){
      $request=Input::all();

      (!isset($request['id'])) ? RekeningPenerimaan::create([
        "nomor_rekening"=>$request['nomorRekening'],
        "uraian"=>$request['uraian'],
        "jenis_pajak_id"=>$request['jenis_pajak_id'],
      ]) : RekeningPenerimaan::where("id",$request['id'])->update([
        "nomor_rekening"=>$request['nomorRekening'],
        "uraian"=>$request['uraian'],
        "jenis_pajak_id"=>$request['jenis_pajak_id'],
      ]);
      // return $request;
      return redirect('admin/rekening');
    }

    public function editRekening(){
      $request=Input::all();
      //dd($request);
      $data['id']=$request['id'];
      $data['jenis_pajak']=JenisPajak::get();

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



    public function wajibPajak(){
      $data['data']=WajibPajak::join('desa','desa.id','=','wajib_pajak.desa_id')->join('kecamatan','desa.kecamatan_id','=','kecamatan.id')->select('wajib_pajak.*','kecamatan.*','desa.*','wajib_pajak.id as id')->get();

      // return $data;
      return view('admin/admin_wajib_pajak',$data);
    }
    public function tambahWajibPajak(){
      $data['kecamatan']=Kecamatan::get();
      $data['desa']=Desa::get();
      return view('admin/admin_tambah_wajib_pajak',$data);
    }
    public function editWajibPajak(){
      $request=Input::all();

      $data['id']=$request['id'];
      $data['kecamatan']=Kecamatan::get();
      $data['desa']=Desa::get();
      $data['edit']=WajibPajak::where('id',$request['id'])->first();
      $data['kecamatan_id']=Desa::where('id',$data['edit']->desa_id)->value('kecamatan_id');
       //dd($data['kecamatan_id']);
      return view('admin/admin_tambah_wajib_pajak',$data);
    }

    public function insertWajibPajak(){
      $request=Input::all();
      $NPWP = preg_replace("/[^0-9]/", "", $request['NPWP'] );

      $query=[
        "nama"=>$request['nama'],
        "npwp"=> $NPWP,
        "alamat"=>$request['alamat'],
        "jatuh_tempo"=>$request['jatuhTempo'],
        "desa_id"=>$request['desa']
      ];

      (!isset($request['id'])) ? WajibPajak::create($query) : WajibPajak::where('id',$request['id'])->update($query);



      return redirect('admin/wajibPajak');
    }

     public function hapusWajibPajak(){
      $request=Input::all();
      $db=WajibPajak::where('id','=',$request['id'])->delete();
      // return $request;
      return redirect('admin/wajibPajak');
    }

    public function getDesa(){
      $request=Input::all();

      $data=Desa::where('kecamatan_id',$request['id'])->get();

      return Response::json($data);
    }
    public function getNPWP(){
      $request=Input::all();

      $NPWP = preg_replace("/[^0-9]/", "", $request['npwp'] );

      $data=WajibPajak::where('npwp','like','%'.$NPWP.'%')->get();
      //dd("masuk");

      return Response::json($data);
    }
    public function getDataWajibPajak(){
      $request=Input::all();

      $data=WajibPajak::where('npwp',$request['npwp'])->first();

      return Response::json($data);
    }




    public function ketetapanPajak(){
      // $data['ketetapanPajak']=WajibPajak::join('ketetapan_pajak','wajib_pajak.id','ketetapan_pajak.wajib_pajak_id')->join('jenis_pajak','ketetapan_pajak.jenis_pajak_id','jenis_pajak.id')->get();

      $data['itemKetetapanPajak']=
          ItemKetetapanPajak::join('ketetapan_pajak','item_ketetapan_pajak.ketetapan_pajak_id','ketetapan_pajak.id')
                ->join('wajib_pajak','wajib_pajak.id','ketetapan_pajak.wajib_pajak_id')
                ->join('jenis_pajak','ketetapan_pajak.jenis_pajak_id','jenis_pajak.id')
                ->whereIn('status_verifikasi',[2,1,0])
                ->select('ketetapan_pajak.*','wajib_pajak.*','jenis_pajak.*','item_ketetapan_pajak.*','item_ketetapan_pajak.id as idikp')
                ->orderBy('item_ketetapan_pajak.id','desc')
                ->paginate(10);
                              //dd($data);
      $data['arr_id'] = array();
      foreach ($data['itemKetetapanPajak'] as $key => $value) {
        $data['arr_id'][] = $value->ketetapan_pajak_id;
      }


      return view('admin/admin_ketetapan_pajak',$data);
    }
    public function tambahKetetapanPajak(){
      $data['kecamatan']=Kecamatan::get();
      $data['desa']=Desa::get();
      $data['rekening']=RekeningPenerimaan::get();
      $data['jenisPajak']=JenisPajak::get();
      //$data['tahun']=Tahun::get();
      //dd($data);

      // return $data['rekening'];
      return view('admin/admin_tambah_ketetapan_pajak',$data);
    }
    public function editKetetapanPajak(){
      $request=Input::all();

      $data['id']=$request['id'];
      $data['kecamatan']=Kecamatan::get();
      $data['desa']=Desa::get();
      $data['rekening']=RekeningPenerimaan::get();
      $data['jenisPajak']=JenisPajak::get();

      $data['edit']=ItemKetetapanPajak::join('ketetapan_pajak','item_ketetapan_pajak.ketetapan_pajak_id','ketetapan_pajak.id')
            ->join('wajib_pajak','wajib_pajak.id','ketetapan_pajak.wajib_pajak_id')
            ->where('item_ketetapan_pajak.id',$request['id'])
            ->first();
            // dd($data['edit']);

      // return $data['rekening'];
      return view('admin/admin_tambah_ketetapan_pajak',$data);
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

      (!isset($request['id'])) ?
      $ketetapanPajak=KetetapanPajak::create($query1) :
      $ketetapanPajak=KetetapanPajak::where('id',$request['id'])->update($query1);

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
          //"ketetapan_pajak_id"=> $request['id']
        ]);
      }

      // (!isset($request['id'])) ?
      //
      // :
      //

      return redirect('admin/ketetapanPajak');
    }
    public function hapusKetetapanPajak(){
      $request=Input::all();

      ItemKetetapanPajak::where('id',$request['id'])->delete();

      return redirect('admin/ketetapanPajak');
    }
    public function statusVerifikasi(){
      $request=Input::all();
      //dd($request);

      ItemKetetapanPajak::where('ketetapan_pajak_id',$request['id'])->update([
        "status_verifikasi"=>1
      ]);

      return redirect('admin/ketetapanPajak');
    }

    public function getEditData(){
      $request=Input::all();

      $data=ItemKetetapanPajak::join('ketetapan_pajak','item_ketetapan_pajak.ketetapan_pajak_id','ketetapan_pajak.id')
            ->join('wajib_pajak','wajib_pajak.id','ketetapan_pajak.wajib_pajak_id')
            ->where('item_ketetapan_pajak.id',$request['id'])
            ->first();
      //dd($data);
      return Response::json($data);
    }
}
