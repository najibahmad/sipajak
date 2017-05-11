@extends('layouts/dashboard_penanggung_jawab')
@section('pegawai-active','class=active')
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
        <form action="{{URL('penanggungJawab/pegawai/tambahPegawai')}}" method="post">
          <button type="submit" class="btn btn-default">Tambah Pegawai</button>
        </form><hr>
        <table class="table table-striped">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Nip</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>Hp</th>
                <th>Grup</th>
                <th>Status</th>
                <th>Nomor Sk</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($pegawai as $no => $ini)
                <tr>
                  <td>{{$no+1}}</td>
                  <td>{{$ini->nama}}</td>
                  <td>{{$ini->nip}}</td>
                  <td>{{$ini->alamat}}</td>
                  <td>{{$ini->email}}</td>
                  <td>{{$ini->hp}}</td>
                  <td>{{$ini->description}}</td>
                  <td>{{$ini->status}}</td>
                  <td>{{$ini->nomor_sk}}</td>
                  <td>
                    <form action="{{URL('penanggungJawab/pegawai/editPegawai')}}" method="post">
                        <input type="hidden" name="id" value="{{$ini->user_id}}">
                        <button type="submit" name="button" class="btn btn-warning">Edit</button>
                    </form>
                    <form action="{{URL('penanggungJawab/pegawai/hapusPegawai')}}" method="post">
                        <input type="hidden" name="id" value="{{$ini->user_id}}">
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
