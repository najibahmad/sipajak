@extends('layouts/horizontal_verifikator')
@section('title','Control Panel')
@section('dashboard-active',"class=active")
@section('content')
  <div class="container">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Wajib Pajak
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> <a href="{{url('admin/verifikator')}}">Beranda</a>
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <hr>
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>No NPWD</th>
                <th>Kecamatan</th>
                <th>Desa/Kelurahan</th>
                <th>Alamat</th>
                <th>Jatuh tempo</th>
                
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $no => $ini)
              <?php
              $npwp = substr($ini->npwp, 0, 2).".".substr($ini->npwp, 2, 3).".".substr($ini->npwp, 5, 3).".".substr($ini->npwp, 8, 1)."-".substr($ini->npwp, 9, 3).".".substr($ini->npwp, 12, 3);

              ?>
                <tr>
                  <td>{{$no+1}}</td>
                  <td>{{$ini->nama}}</td>
                  <td>{{$npwp}}</td>
                  <td>{{$ini->kecamatan}}</td>
                  <td>{{$ini->desa}}</td>
                  <td>{{$ini->alamat}}</td>
                  <td>{{$ini->jatuh_tempo}}</td>
                  
                </tr>
              @endforeach
            </tbody>
          </table>
      </div>
    </div>

  </div>
@endsection
