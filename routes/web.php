<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Login
Route::get('/', function () {
    return redirect('/home');
});

//default laravel auth
Auth::routes();

Route::get('/home', 'HomeController@index');

//baca hak akses
Route::post('checking',function(){

  switch (Auth::user()->role_id) {
    case '1':
        return redirect('/admin');
      break;
    case '2':
        return redirect('/penanggungJawab');
      break;
    case '3':
        return redirect('/bendahara');
      break;
    case '4':
        return redirect('/operator');
      break;
    case '5':
        return redirect('/verifikator');
      break;
    default:
        return redirect('/home');
      break;
  }

});
Route::get('cekRole',function(){
  return Auth::user();
});
Route::get('role',[
  'middleware' => 'role:admin',
  'uses' => 'TestController@index',
]);

Route::group(['middleware'=>'role:1'],function(){
  //jika hak akses admin
  Route::get('/admin','AdminController@index');
  Route::group(['prefix'=>'admin'],function(){
    Route::get('/rekening','AdminController@rekening_penerimaan');
      Route::group(['prefix'=>'/rekening'],function(){
        Route::post('tambahRekening','AdminController@tambahRekening');
        Route::post('insertRekening','AdminController@insertRekening');
        Route::post('editRekening','AdminController@editRekening');
        Route::post('hapusRekening','AdminController@hapusRekening');
      });
    Route::get('/tarif','AdminController@tarif');
      Route::group(['prefix'=>'/tarif'],function(){
        Route::post('tambahTarifPajak','AdminController@tambahTarifPajak');
        Route::post('insertTarifPajak','AdminController@insertTarifPajak');
        Route::post('editTarifPajak','AdminController@editTarifPajak');
        Route::post('hapusTarifPajak','AdminController@hapusTarifPajak');
        Route::post('getStandarTarif','AdminController@getStandarTarif');
      });
    Route::get('/pajak','AdminController@pajak');
      Route::group(['prefix'=>'/pajak'],function(){
        Route::post('tambahJenisPajak','AdminController@tambahJenisPajak');
        Route::post('insertJenisPajak','AdminController@insertJenisPajak');
        Route::post('editJenisPajak','AdminController@editJenisPajak');
        Route::post('hapusJenisPajak','AdminController@hapusJenisPajak');
      });
    Route::get('/pwd','AdminController@pwd');
    Route::group(['prefix'=>'pwd'],function(){
      Route::post('updatePwd','AdminController@updatePwd');
    });
  });
});


Route::group(['middleware'=>'role:2'],function(){
  //jika hak akses penanggung jawab
  Route::get('/penanggungJawab','PjController@index');
  Route::group(['prefix'=>'penanggungJawab'],function(){
    Route::get('pegawai','PjController@pegawai');
      Route::group(['prefix'=>'/pegawai'],function(){
        Route::post('tambahPegawai','PjController@tambahPegawai');
        Route::post('insertPegawai','PjController@insertPegawai');
        Route::post('hapusPegawai','PjController@hapusPegawai');
        Route::post('editPegawai','PjController@editPegawai');
        Route::post('insertEditedPegawai','PjController@insertEditedPegawai');
      });
    Route::get('pwd','PjController@pwd');
    Route::group(['prefix'=>'pwd'],function(){
      Route::post('updatePwd','PjController@updatePwd');
    });
  });
});


Route::group(['middleware'=>'role:3'],function(){
  //jika hak akses bendahara
  Route::get('/bendahara','BendaharaController@index');
  Route::group(['prefix'=>'/bendahara'],function(){
    Route::get('dataPajak','BendaharaController@dataPajak');
    Route::group(['prefix'=>'dataPajak'],function(){
      Route::post('statusPembayaran','BendaharaController@statusPembayaran');
      Route::post('getDataKetetapanPajak','BendaharaController@getDataKetetapanPajak');
    });
    Route::get('laporan','BendaharaController@laporan');
    Route::get('pwd','BendaharaController@pwd');
    Route::group(['prefix'=>'pwd'],function(){
      Route::post('updatePwd','PjController@updatePwd');
    });
  });
});

//Route::post('operator/wajibPajak/getNPWP','OperatorController@getNPWP');


Route::group(['middleware'=>'role:4'],function(){
  //jika hak akses operator
  Route::get('/operator','OperatorController@index');
  Route::group(['prefix'=>'/operator'],function(){
    Route::get('wajibPajak','OperatorController@wajibPajak');
      Route::group(['prefix'=>'/wajibPajak'],function(){
        Route::post('tambahWajibPajak','OperatorController@tambahWajibPajak');
        Route::post('insertWajibPajak','OperatorController@insertWajibPajak');
        Route::post('editWajibPajak','OperatorController@editWajibPajak');
        Route::post('hapusWajibPajak','OperatorController@hapusWajibPajak');
        Route::post('getDesa','OperatorController@getDesa');
        Route::post('getNPWP','OperatorController@getNPWP');
        Route::post('getDataWajibPajak','OperatorController@getDataWajibPajak');
      });
    Route::get('ketetapanPajak','OperatorController@ketetapanPajak');
      Route::group(['prefix'=>'ketetapanPajak'],function(){
        Route::post('tambahKetetapanPajak','OperatorController@tambahKetetapanPajak');
        Route::post('insertKetetapanPajak','OperatorController@insertKetetapanPajak');
        Route::post('editKetetapanPajak','OperatorController@editKetetapanPajak');
        Route::post('hapusKetetapanPajak','OperatorController@hapusKetetapanPajak');
        Route::post('statusVerifikasi','OperatorController@statusVerifikasi');
        Route::post('getDataKetetapanPajak','OperatorController@getDataKetetapanPajak');
        Route::post('getEditData','OperatorController@getEditData');
      });
    Route::get('pwd','OperatorController@pwd');
    Route::group(['prefix'=>'pwd'],function(){
      Route::post('updatePwd','OperatorController@updatePwd');
    });
  });
});


Route::group(['middleware'=>'role:5'],function(){
  //jika hak akses verifikator
  Route::get('/verifikator','VerifikatorController@index');
  Route::group(['prefix'=>'/verifikator'],function(){
    Route::get('verifikasiKetetapanPajak','VerifikatorController@verifikasiKetetapanPajak');
    Route::group(['prefix'=>'verifikasiKetetapanPajak'],function(){
      Route::post('statusVerifikasi','VerifikatorController@statusVerifikasi');
      Route::post('getDataKetetapanPajak','VerifikatorController@getDataKetetapanPajak');
      Route::post('getNPWP','OperatorController@getNPWP');
    });
    Route::get('pwd','VerifikatorController@pwd');
    Route::group(['prefix'=>'pwd'],function(){
      Route::post('updatePwd','VerifikatorController@updatePwd');
    });
  });
});
