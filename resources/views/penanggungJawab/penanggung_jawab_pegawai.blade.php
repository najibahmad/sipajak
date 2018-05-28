@extends('layouts/horizontal_penanggung_jawab')
@section('pegawai-active','class=active')
@section('content')
  <div class="container">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Kepegawaian
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> <a href="{{url('penanggungJawab/pegawai')}}">List pegawai</a>
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <form action="{{URL('penanggungJawab/pegawai/tambahPegawai')}}" method="post">
          <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Pegawai</button>
        </form><hr>
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
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
                    <button type="submit" name="button" class="btn btn-warning" onclick="event.preventDefault();document.getElementById('editPegawai.{{$ini->user_id}}').submit();">Edit</button>
                    <button type="submit" name="button" class="btn btn-danger" onclick="event.preventDefault();document.getElementById('hapusPegawai.{{$ini->user_id}}').submit();">Delete</button>
                    <form id="editPegawai.{{$ini->user_id}}" action="{{URL('penanggungJawab/pegawai/editPegawai')}}" method="post">
                        <input type="hidden" name="id" value="{{$ini->user_id}}">
                    </form>
                    <form id="hapusPegawai.{{$ini->user_id}}" action="{{URL('penanggungJawab/pegawai/hapusPegawai')}}" method="post">
                        <input type="hidden" name="id" value="{{$ini->user_id}}">
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
