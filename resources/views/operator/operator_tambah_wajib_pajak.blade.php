@extends('layouts/dashboard_operator')
@section('title','Control Panel')
@section('dashboard-active',"class=active")
@section('content')
  <div class="container">

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

    <a href="{{URL('operator/wajibPajak')}}"><button type="button" class="btn btn-default" name="button">Back</button></a>
    <hr>
    <!-- /.row -->
    <form class="form-horizontal" action="{{URL('operator/wajibPajak/insertWajibPajak')}}" role="form" method="post">
      <div class="form-group">
        <label class="control-label col-sm-2" for="namaJenisPajak">Nama Jenis Pajak</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="nama" placeholder="Nama">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="NPWP">NPWP:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="NPWP" placeholder="NPWP">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="kecamatan">Kecamatan</label>
        <div class="col-sm-10">
          <select class="form-control" id="sel1" name="kecamatan">
            <option>Silahkan pilih Kecamatan</option>
            @foreach ($kecamatan as $no => $ini)
              <option value="{{$ini->id}}">{{$ini->kecamatan}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="desa">Desa/Kelurahan:</label>
        <div class="col-sm-10">
          <select class="form-control" id="sel1" name="desa">
            <option>Silahkan pilih Desa/Kelurahan</option>
            @foreach ($desa as $no => $ini)
              <option value="{{$ini->id}}">{{$ini->desa}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="alamat">Alamat:</label>
        <div class="col-sm-10">
          <textarea type="text" class="form-control" name="alamat" placeholder="Alamat"></textarea>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="kecamatan">Jatuh Tempo:</label>
        <div class="col-sm-10">
          <input type="text" class="datepicker form-control" data-provide="datepicker" name="jatuhTempo" placeholder="jatuh tempo">
        </div>
      </div>
      <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </form>

  </div>
  
@endsection
