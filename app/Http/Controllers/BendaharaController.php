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
use App\ItemKetetapanPajak;

class BendaharaController extends Controller
{
    public function index(){
      return view('bendahara/bendahara_dashboard');
    }
    public function dataPajak(){
      $data['itemKetetapanPajak']=ItemKetetapanPajak::join('ketetapan_pajak','item_ketetapan_pajak.ketetapan_pajak_id','ketetapan_pajak.id')->join('wajib_pajak','wajib_pajak.id','ketetapan_pajak.wajib_pajak_id')->join('jenis_pajak','ketetapan_pajak.jenis_pajak_id','jenis_pajak.id')->where('status_verifikasi',2)->get();
      return view('bendahara/bendahara_data_pajak',$data);
    }
    public function statusPembayaran(){
      $request=Input::all();

      ItemKetetapanPajak::where('ketetapan_pajak_id',$request['id'])->update([
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

    }
    public function pwd(){

    }
}
