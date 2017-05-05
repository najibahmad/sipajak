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
    });
  Route::get('/pajak','AdminController@pajak');
    Route::group(['prefix'=>'/pajak'],function(){
      Route::post('tambahJenisPajak','AdminController@tambahJenisPajak');
      Route::post('editJenisPajak','AdminController@editJenisPajak');
      Route::post('hapusJenisPajak','AdminController@hapusJenisPajak');
    });
  Route::get('/pwd','AdminController@pwd');
});

//jika hak akses penanggung jawab
Route::get('/penanggungJawab','PjController@index');
Route::group(['prefix'=>'penanggungJawab'],function(){

});

//jika hak akses bendahara
Route::get('/bendahara','BendaharaController@index');
Route::group(['prefix'=>'/bendahara'],function(){

});

//jika hak akses operator
Route::get('/operator','OperatorController@index');
Route::group(['prefix'=>'/operator'],function(){

});

//jika hak akses verifikator
Route::get('/verifikator','VerifikatorController@index');
Route::group(['prefix'=>'/verifikator'],function(){

});
