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
use PDF;

class BendaharaController extends Controller
{
    public function index(){
      return view('bendahara/bendahara_dashboard');
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
        ->where('item_ketetapan_pajak.status_verifikasi',2)->get();

        //dd($data['ketetapanPajak']);

      return view('bendahara/bendahara_data_pajak',$data);
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

      return view('bendahara/bendahara_konfirmasi_pembayaran',$data);

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

      return redirect('bendahara/dataPajak');

    }


    public function getDataKetetapanPajak(){
        $request=Input::all();

        $data=ItemKetetapanPajak::join('ketetapan_pajak','item_ketetapan_pajak.ketetapan_pajak_id','ketetapan_pajak.id')->join('wajib_pajak','wajib_pajak.id','ketetapan_pajak.wajib_pajak_id')->join('jenis_pajak','ketetapan_pajak.jenis_pajak_id','jenis_pajak.id')->where('npwp',$request['npwp'])->where('status_verifikasi',2)->whereIn('status_pembayaran',[1,0])->get();

        return Response::json($data);
    }
    public function laporan(){
      $data['kecamatan']=Kecamatan::get();
      $data['desa']=Desa::get();
      return view('bendahara/bendahara_laporan',$data);

    }
    public function laporanSetoran(){
      $data['kecamatan']=Kecamatan::get();
      $data['desa']=Desa::get();
      return view('bendahara/bendahara_laporan_setoran',$data);

    }
    public function cetak_stbp(){
      $request=Input::all();
      $data['id']=$request['id'];



      $data['KetetapanPajak']=KetetapanPajak::findOrFail($data['id']);

      $data['terbilang']=$this->terbilang($data['itemKetetapanPajak']->harga);
      $data['tgl_hari_ini'] = $this->tgl_hari_ini();



      return view('bendahara/stbp',$data);
    }
    public function cetak_stbp_pdf(Request $request){
      $request=Input::all();
      $data['id']=$request['id'];
      $data['download']=$request['download'];
      //dd($request);

      //dd($request);
      $data['jumlah']=KetetapanPajak::
        join('item_ketetapan_pajak','item_ketetapan_pajak.ketetapan_pajak_id','ketetapan_pajak.id')
        ->select(DB::raw('SUM(harga) as jumlah'))
        ->groupBy('ketetapan_pajak.id')
        ->where('ketetapan_pajak.id',$data['id'])->first();

      $data['ketetapanPajak']=KetetapanPajak::findOrFail($data['id']);
      $data['terbilang']=$this->terbilang($data['jumlah']->jumlah);
      $data['tgl_hari_ini'] = $this->tgl_hari_ini();
      $data['tgl_pembayaran'] = KetetapanPajak::
        join('item_ketetapan_pajak','item_ketetapan_pajak.ketetapan_pajak_id','ketetapan_pajak.id')
        ->select('item_ketetapan_pajak.tgl_pembayaran')
        ->where('ketetapan_pajak.id',$data['id'])->first();
      $data['tgl_pembayaran'] = $this->tgl_indo($data['tgl_pembayaran']->tgl_pembayaran);
      //dd($data['ketetapanPajak']->item_ketetapan_pajak);
      //untuk pdf


      if($data['download'] == 'pdf'){
          view()->share('ketetapanPajak',$data['ketetapanPajak']);
          view()->share('terbilang',$data['terbilang']);
          view()->share('jumlah',$data['jumlah']->jumlah);
          view()->share('tgl_hari_ini',$data['tgl_hari_ini']);
          view()->share('tgl_pembayaran',$data['tgl_pembayaran']);
          $pdf = PDF::loadView('bendahara.stbp');
          return $pdf->stream('laporan.pdf');

            //return view('report.print.p_coba');
        }


      return view('bendahara/stbp',$data);
    }
    public function cetak_setoranbank_pdf(Request $request){
      $request=Input::all();
      $data['id']=$request['id'];
      $data['download']=$request['download'];
      //dd($request);

      //dd($request);
      $data['jumlah']=KetetapanPajak::
        join('item_ketetapan_pajak','item_ketetapan_pajak.ketetapan_pajak_id','ketetapan_pajak.id')
        ->select(DB::raw('SUM(harga) as jumlah'))
        ->groupBy('ketetapan_pajak.id')
        ->where('ketetapan_pajak.id',$data['id'])->first();

      $data['ketetapanPajak']=KetetapanPajak::findOrFail($data['id']);
      $data['terbilang']=$this->terbilang($data['jumlah']->jumlah);
      $data['tgl_hari_ini'] = $this->tgl_hari_ini();
      $data['tgl_pembayaran'] = KetetapanPajak::
        join('item_ketetapan_pajak','item_ketetapan_pajak.ketetapan_pajak_id','ketetapan_pajak.id')
        ->select('item_ketetapan_pajak.tgl_pembayaran')
        ->where('ketetapan_pajak.id',$data['id'])->first();
      $data['tgl_pembayaran'] = $this->tgl_indo($data['tgl_pembayaran']->tgl_pembayaran);

      //dd($data['ketetapanPajak']->item_ketetapan_pajak);
      //untuk pdf


      if($data['download'] == 'pdf'){
          view()->share('ketetapanPajak',$data['ketetapanPajak']);
          view()->share('terbilang',$data['terbilang']);
          view()->share('jumlah',$data['jumlah']->jumlah);
          view()->share('tgl_hari_ini',$data['tgl_hari_ini']);
          view()->share('tgl_pembayaran',$data['tgl_pembayaran']);
          $pdf = PDF::loadView('bendahara.setoranbank')->setPaper('A4', 'landscape');;
          return $pdf->stream('setoranbank.pdf');

            //return view('report.print.p_coba');
        }


      return view('bendahara/setoranbank',$data);
    }
    public function pwd(){
      return view('bendahara/bendahara_pwd');
    }
    public function updatePwd(){
      $request=Input::all();
      // return $currentId=Auth::user()->id;
      User::where('id',Auth::user()->id)->update([
        "password"=>bcrypt($request['pwd'])
      ]);

      return redirect('bendahara/pwd');
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
      return view('bendahara/bendahara_laporan',$data);
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
      return view('bendahara/bendahara_laporan_setoran',$data);
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
