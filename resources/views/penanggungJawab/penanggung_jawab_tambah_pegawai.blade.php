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

    <a href="{{URL('penanggungJawab/pegawai')}}"><button type="button" class="btn btn-default" name="button">Back</button></a>
    <hr>
    <!-- /.row -->
    <form class="form-horizontal" action="{{URL('penanggungJawab/pegawai/insertPegawai')}}" role="form" method="post">
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
          <select class="form-control" name="status">
            <option value="aktif">Aktif</option>
            <option value="tidak_aktif">Tidak aktif</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="bulan">Grup: </label>
        <div class="col-sm-10">
          <select class="form-control" name="grup">
            @foreach ($roles as $id => $ini)
              <option value="{{$ini->id}}">{{$ini->description}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="bulan">Nomor SK: </label>
        <div class="col-sm-10">
          <input type="text" class="form-control" placeholder="Nomor SK" name="nomorSK">
        </div>
      </div>

      <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </form>

  </div>
@endsection
