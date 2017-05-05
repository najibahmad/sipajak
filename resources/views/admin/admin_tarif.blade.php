@extends('layouts/dashboard_admin')
@section('title','Control Panel')
@section('tarif-active',"class=active")
@section('content')
  <div class="container">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Standar Tarif Pajak
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> <a href="{{url('admin/dashboard')}}">List Tarif Pajak</a>
                </li>
            </ol>
        </div>
    </div>
    <hr>
    <form class="" action="index.html" method="post">
      <div class="form-group">
        <label for="sel1">Standar Tarif Pajak Tahun:</label>
        <select class="form-control" id="sel1">
          <option>2017</option>
          <option>2016</option>
          <option>2015</option>
          <option>2014</option>
        </select>
      </div>
    </form>

    <div class="row">
      <div class="col-lg-12">
        <form action="{{URL('admin/tarif/tambahTarifPajak')}}" method="post">
          <button type="submit" class="btn btn-default">Tambah Rekening Penerimaan</button>
        </form><hr>
        <table class="table table-striped">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama Item</th>
                <th>Jenis</th>
                <th>Satuan</th>
                <th>Tarif</th>
                <th>Tahun</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $no => $ini)
                <tr>
                  <td>{{$no+1}}</td>
                  <td>{{$ini->nama_item}}</td>
                  <td>{{$ini->jenis}}</td>
                  <td>{{$ini->satuan}}</td>
                  <td>{{$ini->tarif}}</td>
                  <td>{{$ini->tahun}}</td>
                  <td>
                    <form class="" action="{{URL('admin/tarif/editTarifPajak')}}" method="post">
                        <button type="submit" name="button" class="btn btn-warning">Edit</button>
                    </form>
                    <form class="" action="{{URL('admin/tarif/hapusTarifPajak')}}" method="post">
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
