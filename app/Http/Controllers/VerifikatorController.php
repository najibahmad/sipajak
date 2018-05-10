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

class VerifikatorController extends Controller
{
    public function index(){
      return view('verifikator/verifikator_dashboard');
    }
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

      return view('verifikator/verifikator_ketetapan_pajak',$data);
    }
    public function statusVerifikasi(){
      $request=Input::all();

      $max = DB::table('ketetapan_pajak')->max('nomor_skp');
      $max = $max + 1;

      ItemKetetapanPajak::where('ketetapan_pajak_id',$request['id'])->update([
        "status_verifikasi"=>2,
      ]);

      KetetapanPajak::where('id',$request['id'])->update([
        "nomor_skp"=>$max,
      ]);

      return redirect('verifikator/verifikasiKetetapanPajak');
    }
    public function getDataKetetapanPajak(){
      $request=Input::all();

      $data=ItemKetetapanPajak::join('ketetapan_pajak','item_ketetapan_pajak.ketetapan_pajak_id','ketetapan_pajak.id')->join('wajib_pajak','wajib_pajak.id','ketetapan_pajak.wajib_pajak_id')->join('jenis_pajak','ketetapan_pajak.jenis_pajak_id','jenis_pajak.id')->where('npwp',$request['npwp'])->whereIn('status_verifikasi',[1,2])->get();

      return Response::json($data);
    }
    public function pwd(){
      return view('verifikator/verifikator_pwd');
    }

    public function updatePwd(){
      $request=Input::all();
      // return $currentId=Auth::user()->id;
      User::where('id',Auth::user()->id)->update([
        "password"=>bcrypt($request['pwd'])
      ]);

      return redirect('verifikator/pwd');
    }



    public function laporan(){
      $data['kecamatan']=Kecamatan::get();
      $data['desa']=Desa::get();
      return view('verifikator/verifikator_laporan',$data);

    }
    public function laporanSetoran(){
      $data['kecamatan']=Kecamatan::get();
      $data['desa']=Desa::get();
      return view('verifikator/verifikator_laporan_setoran',$data);

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
      return view('verifikator/verifikator_laporan',$data);
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
      return view('verifikator/verifikator_laporan_setoran',$data);
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

      return view('verifikator/verifikator_data_pajak',$data);
    }




    public function wajibPajak(){
      $data['data']=WajibPajak::join('desa','desa.id','=','wajib_pajak.desa_id')->join('kecamatan','desa.kecamatan_id','=','kecamatan.id')->select('wajib_pajak.*','kecamatan.*','desa.*','wajib_pajak.id as id')->get();

      // return $data;
      return view('verifikator/verifikator_wajib_pajak',$data);
    }

    public function ketetapanPajak(){
      // $data['ketetapanPajak']=WajibPajak::join('ketetapan_pajak','wajib_pajak.id','ketetapan_pajak.wajib_pajak_id')->join('jenis_pajak','ketetapan_pajak.jenis_pajak_id','jenis_pajak.id')->get();

      $data['itemKetetapanPajak']=
          ItemKetetapanPajak::join('ketetapan_pajak','item_ketetapan_pajak.ketetapan_pajak_id','ketetapan_pajak.id')
                ->join('wajib_pajak','wajib_pajak.id','ketetapan_pajak.wajib_pajak_id')
                ->join('jenis_pajak','ketetapan_pajak.jenis_pajak_id','jenis_pajak.id')
                ->whereIn('status_verifikasi',[1,0])
                ->select('ketetapan_pajak.*','wajib_pajak.*','jenis_pajak.*','item_ketetapan_pajak.*','item_ketetapan_pajak.id as idikp')
                ->orderBy('item_ketetapan_pajak.id','desc')
                ->paginate(10);
                              //dd($data);
      $data['arr_id'] = array();
      foreach ($data['itemKetetapanPajak'] as $key => $value) {
        $data['arr_id'][] = $value->ketetapan_pajak_id;
      }


      return view('verifikator/verifikator_operator_ketetapan_pajak',$data);
    }


}
