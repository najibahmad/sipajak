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
      $data['itemKetetapanPajak']=ItemKetetapanPajak::join('ketetapan_pajak','item_ketetapan_pajak.ketetapan_pajak_id','ketetapan_pajak.id')->join('wajib_pajak','wajib_pajak.id','ketetapan_pajak.wajib_pajak_id')->join('jenis_pajak','ketetapan_pajak.jenis_pajak_id','jenis_pajak.id')->whereIn('status_verifikasi',[1,2])->get();

      return view('verifikator/verifikator_ketetapan_pajak',$data);
    }
    public function statusVerifikasi(){
      $request=Input::all();

      ItemKetetapanPajak::where('ketetapan_pajak_id',$request['id'])->update([
        "status_verifikasi"=>2
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
}
