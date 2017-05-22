@extends('layouts/dashboard_operator')
@section('title','Control Panel')
@section('dashboard-active',"class=active")
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

    <div class="row">
      <div class="col-lg-12">
        <form action="{{URL('operator/wajibPajak/tambahWajibPajak')}}" method="post">
          <button type="submit" class="btn btn-default">Tambah Jenis Pajak</button>
        </form><hr>
        <table class="table table-striped">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>No NPWP</th>
                <th>Kecamatan</th>
                <th>Desa/Kelurahan</th>
                <th>Alamat</th>
                <th>Jatuh tempo</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $no => $ini)
                <tr>
                  <td>{{$no+1}}</td>
                  <td>{{$ini->nama}}</td>
                  <td>{{$ini->npwp}}</td>
                  <td>{{$ini->kecamatan}}</td>
                  <td>{{$ini->desa}}</td>
                  <td>{{$ini->alamat}}</td>
                  <td>{{$ini->jatuh_tempo}}</td>
                  <td>
                    <form action="{{URL('operator/wajibPajak/editWajibPajak')}}" method="post">
                        <input type="hidden" name="id" value="{{$ini->id}}">
                        <button type="submit" name="button" class="btn btn-warning">Edit</button>
                    </form>
                    <form action="{{URL('operator/wajibPajak/hapusWajibPajak')}}" method="post">
                        <input type="hidden" name="id" value="{{$ini->id}}">
                        <button type="submit" name="button" class="btn btn-danger">Delete</button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
      </div>
    </div>

  </div>
@endsection
