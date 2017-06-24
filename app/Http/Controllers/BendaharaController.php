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
      $data['itemKetetapanPajak']=ItemKetetapanPajak::
        join('ketetapan_pajak','item_ketetapan_pajak.ketetapan_pajak_id','ketetapan_pajak.id')
        ->join('wajib_pajak','wajib_pajak.id','ketetapan_pajak.wajib_pajak_id')
        ->join('jenis_pajak','ketetapan_pajak.jenis_pajak_id','jenis_pajak.id')
        ->select('item_ketetapan_pajak.*','ketetapan_pajak.*','wajib_pajak.*','jenis_pajak.*','item_ketetapan_pajak.id as id_item')
        ->where('status_verifikasi',2)->get();
      //dd($data);
      return view('bendahara/bendahara_data_pajak',$data);
    }
    public function statusPembayaran(){
      $request=Input::all();

      ItemKetetapanPajak::where('id',$request['id'])->update([
        "status_pembayaran"=>1
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
    public function cetak_stbp(){
      $request=Input::all();
      $data['id']=$request['id'];

      //dd($request);

      $data['itemKetetapanPajak']=ItemKetetapanPajak::findOrFail($data['id']);
      $data['terbilang']=$this->terbilang($data['itemKetetapanPajak']->harga);
      $data['tgl_hari_ini'] = $this->tgl_hari_ini();



      return view('bendahara/stbp',$data);
    }
    public function cetak_stbp_pdf(Request $request){
      $request=Input::all();
      $data['id']=$request['id'];
      $data['download']=$request['download'];
      //dd($request);

      $data['itemKetetapanPajak']=ItemKetetapanPajak::findOrFail($data['id']);
      $data['terbilang']=$this->terbilang($data['itemKetetapanPajak']->harga);
      $data['tgl_hari_ini'] = $this->tgl_hari_ini();

      //untuk pdf
      $itemKetetapanPajak=ItemKetetapanPajak::findOrFail($data['id']);
      $terbilang=$this->terbilang($data['itemKetetapanPajak']->harga);
      $tgl_hari_ini = $this->tgl_hari_ini();

      if($data['download'] == 'pdf'){
          view()->share('itemKetetapanPajak',$itemKetetapanPajak);
          view()->share('terbilang',$terbilang);
          view()->share('tgl_hari_ini',$tgl_hari_ini);
          $pdf = PDF::loadView('bendahara.stbp');
          return $pdf->stream('laporan.pdf');

            //return view('report.print.p_coba');
        }


      return view('bendahara/stbp',$data);
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

}
