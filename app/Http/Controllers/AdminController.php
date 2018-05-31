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


    // VERIFIKATOR ===========
    public function verifikasiKetetapanPajak(){
      $data['itemKetetapanPajak']=ItemKetetapanPajak::
      join('ketetapan_pajak','item_ketetapan_pajak.ketetapan_pajak_id','ketetapan_pajak.id')
      ->join('wajib_pajak','wajib_pajak.id','ketetapan_pajak.wajib_pajak_id')
      ->join('jenis_pajak','ketetapan_pajak.jenis_pajak_id','jenis_pajak.id')
      ->whereIn('status_verifikasi',[1,2])->orderBy('ketetapan_pajak.id', 'desc')
                ->get();

      $data['arr_id'] = array();
      foreach ($data['itemKetetapanPajak'] as $key => $value) {
        $data['arr_id'][] = $value->ketetapan_pajak_id;
      }

      return view('admin/admin_verifikasi_pajak',$data);
    }
    public function adminVerifikasi(){
      $request=Input::all();

      $max = DB::table('ketetapan_pajak')->max('nomor_skp');
      $max = $max + 1;

      ItemKetetapanPajak::where('ketetapan_pajak_id',$request['id'])->update([
        "status_verifikasi"=>2,
      ]);

      KetetapanPajak::where('id',$request['id'])->update([
        "nomor_skp"=>$max,
      ]);

      return redirect('admin/verifikasiKetetapanPajak');
    }
    public function getDataKetetapanPajak(){
      $request=Input::all();

      $data=ItemKetetapanPajak::join('ketetapan_pajak','item_ketetapan_pajak.ketetapan_pajak_id','ketetapan_pajak.id')->join('wajib_pajak','wajib_pajak.id','ketetapan_pajak.wajib_pajak_id')->join('jenis_pajak','ketetapan_pajak.jenis_pajak_id','jenis_pajak.id')->where('npwp',$request['npwp'])->whereIn('status_verifikasi',[1,2])->get();

      return Response::json($data);
    }
    // VERIFIKATOR ===========



    //BENDAHARA
    public function dataPajak(){
      /*
      $data['itemKetetapanPajak']=ItemKetetapanPajak::
        join('ketetapan_pajak','item_ketetapan_pajak.ketetapan_pajak_id','ketetapan_pajak.id')
        ->join('wajib_pajak','wajib_pajak.id','ketetapan_pajak.wajib_pajak_id')
        ->join('jenis_pajak','ketetapan_pajak.jenis_pajak_id','jenis_pajak.id')
        ->select('item_ketetapan_pajak.*','ketetapan_pajak.*','wajib_pajak.*','jenis_pajak.*','item_ketetapan_pajak.id as id_item')
        ->where('status_verifikasi',2)->get();
      */
      $data['ketetapanPajak']=KetetapanPajak::
        join('wajib_pajak','wajib_pajak.id','ketetapan_pajak.wajib_pajak_id')
        ->join('item_ketetapan_pajak','item_ketetapan_pajak.ketetapan_pajak_id','ketetapan_pajak.id')
        ->join('jenis_pajak','ketetapan_pajak.jenis_pajak_id','jenis_pajak.id')
        ->select('ketetapan_pajak.id','ketetapan_pajak.jatuh_tempo','ketetapan_pajak.nama_pekerjaan','wajib_pajak.nama','wajib_pajak.npwp','jenis_pajak.jenis','ketetapan_pajak.tgl_pembayaran',
                'ketetapan_pajak.id as id_ketetapan',DB::raw('SUM(harga) as jumlah'),'item_ketetapan_pajak.status_pembayaran')
        ->groupBy('ketetapan_pajak.id','wajib_pajak.nama',
                  'wajib_pajak.npwp','jenis_pajak.jenis','ketetapan_pajak.nama_pekerjaan',
                  'ketetapan_pajak.jatuh_tempo','item_ketetapan_pajak.status_pembayaran','ketetapan_pajak.tgl_pembayaran')
        ->where('item_ketetapan_pajak.status_verifikasi',2)->orderBy('ketetapan_pajak.id', 'desc')
                  ->get();

        //dd($data['ketetapanPajak']);

      return view('admin/bendahara/bendahara_data_pajak',$data);
    }

    public function statusPembayaran(){
      $request=Input::all();

      //sisipkan form konfirmasi pembayaran untuk item apa saja
      $data['ketetapanPajak']=ketetapanPajak::findOrFail($request['id']);
      $data['itemKetetapanPajak']=ItemKetetapanPajak::where('ketetapan_pajak_id','=',$request['id'])->get();

      $max = DB::table('ketetapan_pajak')->max('nomor_pembayaran');
      $data['nomor'] = $max + 1;

      //nomor_bukti
      $data['nomor_bukti']=$data['nomor']."/DPKKA/".date('y');
      //dd($data);

      return view('admin/bendahara/bendahara_konfirmasi_pembayaran',$data);

      //dd($data);
      /*
      ItemKetetapanPajak::where('ketetapan_pajak_id',$request['id'])->update([
        "status_pembayaran"=>1,
        "tgl_pembayaran" => date("Y-m-d")
      ]);

      return redirect('bendahara/dataPajak');
      */
    }

    public function prosesPembayaran(){
      $request=Input::all();

      ketetapanPajak::where('id',$request['id'])->update([
        "jumlah_dibayar"=>$request['jumlah_dibayar'],
        "nomor_pembayaran"=>$request['nomor'],
        "nomor_bukti"=>$request['nomor_bukti'],
        "tgl_pembayaran" => date("Y-m-d")
      ]);

      ItemKetetapanPajak::where('ketetapan_pajak_id',$request['id'])->update([
        "status_pembayaran"=>1,
        "tgl_pembayaran" => date("Y-m-d")
      ]);

      return redirect('admin/dataPajak');

    }

    public function laporan(){
      $data['kecamatan']=Kecamatan::get();
      $data['desa']=Desa::get();
      return view('admin/bendahara/bendahara_laporan',$data);

    }
    public function laporanSetoran(){
      $data['kecamatan']=Kecamatan::get();
      $data['desa']=Desa::get();
      return view('admin/bendahara/bendahara_laporan_setoran',$data);

    }
    public function buku_besar(){
      $data['kecamatan']=Kecamatan::get();
      $data['desa']=Desa::get();
      $data['jenis_pajak']=JenisPajak::get();
      return view('admin/bendahara/bendahara_buku_besar',$data);

    }

    public function filterLaporan(){
      $request=Input::all();
      $data['filter'] = 1;
      $data['kecamatan']=Kecamatan::get();
      $data['desa']=Desa::get();
      // return $currentId=Auth::user()->id;
      //dd($request);
      $data['laporan']=KetetapanPajak::
        join('item_ketetapan_pajak','item_ketetapan_pajak.ketetapan_pajak_id','ketetapan_pajak.id')
        ->select('nama_pekerjaan','jatuh_tempo',DB::raw('SUM(harga) as jumlah'),'ketetapan_pajak.tgl_pembayaran','ketetapan_pajak.jumlah_dibayar','ketetapan_pajak.nomor_skp','ketetapan_pajak.nomor_pembayaran')
        ->whereRaw("ketetapan_pajak.tgl_pembayaran > '".$request['tgl_awal']."'")
        ->whereRaw("ketetapan_pajak.tgl_pembayaran < '".$request['tgl_akhir']."'")
        ->groupBy('ketetapan_pajak.id','ketetapan_pajak.jatuh_tempo','ketetapan_pajak.nama_pekerjaan',
                  'ketetapan_pajak.tgl_pembayaran','ketetapan_pajak.jumlah_dibayar','ketetapan_pajak.nomor_skp','ketetapan_pajak.nomor_pembayaran')
        ->get();

        //isset data
        $data['tgl_awal'] = $request['tgl_awal'];
        $data['tgl_akhir'] = $request['tgl_akhir'];

        $data['tgl_awal1'] = $this->tgl_indo2($request['tgl_awal']);
        $data['tgl_akhir1'] = $this->tgl_indo2($request['tgl_akhir']);

      //dd($data['laporan']);
      return view('admin/bendahara/bendahara_laporan',$data);
    }

    public function filterLaporanSetoran(){
      $request=Input::all();
      $data['filter'] = 1;
      $data['kecamatan']=Kecamatan::get();
      $data['desa']=Desa::get();
      // return $currentId=Auth::user()->id;
      //dd($request);
      $data['laporan']=KetetapanPajak::
        join('item_ketetapan_pajak','item_ketetapan_pajak.ketetapan_pajak_id','ketetapan_pajak.id')
        ->select('nama_pekerjaan','nomor_bukti','jatuh_tempo',DB::raw('SUM(harga) as jumlah'),'ketetapan_pajak.tgl_pembayaran','ketetapan_pajak.jumlah_dibayar','ketetapan_pajak.nomor_skp','ketetapan_pajak.nomor_pembayaran')
        ->whereRaw("ketetapan_pajak.tgl_pembayaran > '".$request['tgl_awal']."'")
        ->whereRaw("ketetapan_pajak.tgl_pembayaran < '".$request['tgl_akhir']."'")

        ->groupBy('ketetapan_pajak.id','ketetapan_pajak.jatuh_tempo','ketetapan_pajak.nama_pekerjaan',
                  'ketetapan_pajak.tgl_pembayaran','ketetapan_pajak.jumlah_dibayar','ketetapan_pajak.nomor_skp','ketetapan_pajak.nomor_pembayaran','ketetapan_pajak.nomor_bukti')
        ->get();

        //isset data
        $data['tgl_awal'] = $request['tgl_awal'];
        $data['tgl_akhir'] = $request['tgl_akhir'];

        $data['tgl_awal1'] = $this->tgl_indo2($request['tgl_awal']);
        $data['tgl_akhir1'] = $this->tgl_indo2($request['tgl_akhir']);

      //dd($data['laporan']);
      return view('admin/bendahara/bendahara_laporan_setoran',$data);
    }

    public function filterbuku_besar(){
      $request=Input::all();
      $data['filter'] = 1;
      $data['kecamatan']=Kecamatan::get();
      $data['desa']=Desa::get();
      // return $currentId=Auth::user()->id;
      //dd($request);
      $query=KetetapanPajak::
        join('item_ketetapan_pajak','item_ketetapan_pajak.ketetapan_pajak_id','ketetapan_pajak.id')
        ->join('wajib_pajak','wajib_pajak.id','ketetapan_pajak.wajib_pajak_id')
        ->join('desa','wajib_pajak.desa_id','desa.id')
        ->join('kecamatan','desa.kecamatan_id','kecamatan.id')

        ->select('npwp','nomor_bukti','nama_pekerjaan','nomor_bukti','ketetapan_pajak.jatuh_tempo',DB::raw('SUM(harga) as jumlah'),'ketetapan_pajak.tgl_pembayaran','ketetapan_pajak.jumlah_dibayar','ketetapan_pajak.nomor_skp','ketetapan_pajak.nomor_pembayaran')
        ->whereRaw("ketetapan_pajak.tgl_pembayaran > '".$request['tgl_awal']."'")
        ->whereRaw("ketetapan_pajak.tgl_pembayaran < '".$request['tgl_akhir']."'")
        ->where("ketetapan_pajak.jenis_pajak_id", $request['jenis_pajak_id']);

        if($request['kecamatan_id'] != 0 )
          $query = $query->where("kecamatan.id", $request['kecamatan_id']);


        $data['laporan'] = $query
        ->groupBy('ketetapan_pajak.id','ketetapan_pajak.jatuh_tempo','ketetapan_pajak.nama_pekerjaan',
                  'ketetapan_pajak.tgl_pembayaran','ketetapan_pajak.jumlah_dibayar','ketetapan_pajak.nomor_skp','ketetapan_pajak.nomor_pembayaran','ketetapan_pajak.nomor_bukti','wajib_pajak.npwp')
        ->get();


        //isset data
        $data['tgl_awal'] = $request['tgl_awal'];
        $data['tgl_akhir'] = $request['tgl_akhir'];
        $data['kecamatan_id'] = $request['kecamatan_id'];
        $data['jenis_pajak_id'] = $request['jenis_pajak_id'];
        $data['jenis_pajak']=JenisPajak::get();
        $data['buku_besar']=JenisPajak::where('id',$request['jenis_pajak_id'])->value('jenis');
        $data['nomor_rekening']=RekeningPenerimaan::where('jenis_pajak_id',$request['jenis_pajak_id'])->value('nomor_rekening');

        $data['tgl_awal1'] = $this->tgl_indo2($request['tgl_awal']);
        $data['tgl_akhir1'] = $this->tgl_indo2($request['tgl_akhir']);

      //dd($data['laporan']);
      return view('admin/bendahara/bendahara_buku_besar',$data);
    }

    public function terbilang ($angka) {
        $angka = (float)$angka;
        $bilangan = array('','Satu','Dua','Tiga','Empat','Lima','Enam','Tujuh','Delapan','Sembilan','Sepuluh','Sebelas');
        if ($angka < 12) {
            return $bilangan[$angka];
        } else if ($angka < 20) {
            return $bilangan[$angka - 10] . ' Belas';
        } else if ($angka < 100) {
            $hasil_bagi = (int)($angka / 10);
            $hasil_mod = $angka % 10;
            return trim(sprintf('%s Puluh %s', $bilangan[$hasil_bagi], $bilangan[$hasil_mod]));
        } else if ($angka < 200) { return sprintf('Seratus %s', $this->terbilang($angka - 100));
        } else if ($angka < 1000) { $hasil_bagi = (int)($angka / 100); $hasil_mod = $angka % 100; return trim(sprintf('%s Ratus %s', $bilangan[$hasil_bagi], $this->terbilang($hasil_mod)));
        } else if ($angka < 2000) { return trim(sprintf('Seribu %s', $this->terbilang($angka - 1000)));
        } else if ($angka < 1000000) { $hasil_bagi = (int)($angka / 1000); $hasil_mod = $angka % 1000; return sprintf('%s Ribu %s', $this->terbilang($hasil_bagi), $this->terbilang($hasil_mod));
        } else if ($angka < 1000000000) { $hasil_bagi = (int)($angka / 1000000); $hasil_mod = $angka % 1000000; return trim(sprintf('%s Juta %s', $this->terbilang($hasil_bagi), $this->terbilang($hasil_mod)));
        } else if ($angka < 1000000000000) { $hasil_bagi = (int)($angka / 1000000000); $hasil_mod = fmod($angka, 1000000000); return trim(sprintf('%s Milyar %s', $this->terbilang($hasil_bagi), $this->terbilang($hasil_mod)));
        } else if ($angka < 1000000000000000) { $hasil_bagi = $angka / 1000000000000; $hasil_mod = fmod($angka, 1000000000000); return trim(sprintf('%s Triliun %s', $this->terbilang($hasil_bagi), $this->terbilang($hasil_mod)));
        } else {
            return 'Data Salah';
        }
    }

    public function tgl_hari_ini(){

      $bulan = array (1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
      );
  $split = explode('-', date("Y-m-d"));
   return ($split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0]);

    }

    public function tgl_indo(){

      $bulan = array (1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
      );
  $split = explode('-', date("Y-m-d"));
   return ($split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0]);

    }

    public function tgl_indo2($tgl){

      $bulan = array (1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
      );
  $split = explode('-', date($tgl));
   return ($split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0]);

    }
}
