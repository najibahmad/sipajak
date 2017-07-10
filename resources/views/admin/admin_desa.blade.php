@extends('layouts/horizontal_admin')
@section('title','Control Panel')
@section('pajak-active',"class=active")
@section('content')
  <div class="container">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Desa
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> <a href="{{url('admin/desa')}}">List Desa</a>
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-lg-12">
        <form action="{{URL('admin/desa/tambahDesa')}}" method="post">
          <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Desa</button>
        </form><hr>
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
              <tr>
                <th>No.</th>
                <th>Desa</th>
                <th>Kecamatan</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $no => $ini)
                <tr>
                  <td>{{$no+1}}</td>
                  <td>{{$ini->desa}}</td>
                  <td>{{$ini->kecamatan->kecamatan}}</td>
                  <td>
                    <button type="submit" name="button" class="btn btn-warning" onclick="event.preventDefault();document.getElementById('editDesa.{{$ini->id}}').submit();">Edit</button>
                    <button type="submit" name="button" class="btn btn-danger" onclick="event.preventDefault();document.getElementById('hapusDesa.{{$ini->id}}').submit();">Delete</button>
                    <form id="editDesa.{{$ini->id}}" action="{{URL('admin/desa/editDesa')}}" method="post">
                        <input type="hidden" name="id" value="{{$ini->id}}">
                    </form>
                    <form id="hapusDesa.{{$ini->id}}" action="{{URL('admin/desa/hapusDesa')}}" method="post">
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
