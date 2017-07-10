@extends('layouts/horizontal_admin')
@section('title','Control Panel')
@section('pajak-active',"class=active")
@section('content')
  <div class="container">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Kecamatan
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> <a href="{{url('admin/kecamatan')}}">List Kecamatan</a>
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-lg-12">
        <form action="{{URL('admin/kecamatan/tambahKecamatan')}}" method="post">
          <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Kecamatan</button>
        </form><hr>
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
              <tr>
                <th>No.</th>
                <th>Kecamatan</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $no => $ini)
                <tr>
                  <td>{{$no+1}}</td>
                  <td>{{$ini->kecamatan}}</td>
                  <td>
                    <button type="submit" name="button" class="btn btn-warning" onclick="event.preventDefault();document.getElementById('editKecamatan.{{$ini->id}}').submit();">Edit</button>
                    <button type="submit" name="button" class="btn btn-danger" onclick="event.preventDefault();document.getElementById('hapusKecamatan.{{$ini->id}}').submit();">Delete</button>
                    <form id="editKecamatan.{{$ini->id}}" action="{{URL('admin/kecamatan/editKecamatan')}}" method="post">
                        <input type="hidden" name="id" value="{{$ini->id}}">
                    </form>
                    <form id="hapusKecamatan.{{$ini->id}}" action="{{URL('admin/kecamatan/hapusKecamatan')}}" method="post">
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
