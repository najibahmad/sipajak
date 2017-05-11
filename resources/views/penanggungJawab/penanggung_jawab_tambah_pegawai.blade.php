@extends('layouts/dashboard_penanggung_jawab')
@section('title','Control Panel')
@section('pegawai-active',"class=active")
@section('content')
  <div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Beranda
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> <a href="{{url('admin/dashboard')}}">Beranda</a>
                </li>
            </ol>
        </div>
    </div>

    <a href="{{URL('operator/ketetapanPajak')}}"><button type="button" class="btn btn-default" name="button">Back</button></a>
    <hr>
    <!-- /.row -->
    <form class="form-horizontal" action="{{URL('operator/ketetapanPajak/insertKetetapanPajak')}}" role="form" method="post">
      <div class="form-group">
        <label class="control-label col-sm-2" for="bulan">Nama: </label>
        <div class="col-sm-10">
          <input type="text" class="form-control" placeholder="Nama anda" name="name">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="bulan">NIP: </label>
        <div class="col-sm-10">
          <input type="text" class="form-control" placeholder="NIP" name="NIP">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="bulan">Alamat: </label>
        <div class="col-sm-10">
          <input type="text" class="form-control" placeholder="Alamat" name="alamat">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="bulan">E-mail: </label>
        <div class="col-sm-10">
          <input type="text" class="form-control" placeholder="E-mail" name="email">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="bulan">HP: </label>
        <div class="col-sm-10">
          <input type="text" class="form-control" placeholder="Nomor yang dapat dihubungi" name="HP">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="bulan">Status: </label>
        <div class="col-sm-10">
          <input type="text" class="form-control" placeholder="Menikah atau Jomblo" name="status">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="bulan">Grup: </label>
        <div class="col-sm-10">
          <input type="text" class="form-control" placeholder="Hak Akses Anda" name="grup">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="bulan">Nomor SK: </label>
        <div class="col-sm-10">
          <input type="text" class="form-control" placeholder="Nomor SK" name="nomorSK">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="bulan">Photo: </label>
        <div class="col-sm-10">
          <input type="file" placeholder="Nama anda" name="choosenFile">
        </div>
      </div>

      <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </form>

  </div>
@endsection
