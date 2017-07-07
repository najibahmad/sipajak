@extends('layouts/horizontal_operator')
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
                    <i class="fa fa-dashboard"></i> <a href="{{url('admin/operator')}}">Beranda</a>
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <form action="{{URL('operator/wajibPajak/tambahWajibPajak')}}" method="post">
          <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Wajib Pajak</button>
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
                    <button type="submit" name="button" class="btn btn-warning" onclick="event.preventDefault();document.getElementById('editWajibPajak.{{$ini->id}}').submit();">Edit</button>
                    <button type="submit" name="button" class="btn btn-danger" onclick="event.preventDefault();document.getElementById('hapusWajibPajak.{{$ini->id}}').submit();">Delete</button>
                    <form id="editWajibPajak.{{$ini->id}}" action="{{URL('operator/wajibPajak/editWajibPajak')}}" method="post">
                        <input type="hidden" name="id" value="{{$ini->id}}">
                    </form>
                    <form id="hapusWajibPajak.{{$ini->id}}" action="{{URL('operator/wajibPajak/hapusWajibPajak')}}" method="post">
                        <input type="hidden" name="id" value="{{$ini->id}}">
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
