@extends('layouts/dashboard_admin')
@section('title','Control Panel')
@section('rekening-active',"class=active")
@section('content')
  <div class="container">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Rekening Penerimaan
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> <a href="{{url('admin/dashboard')}}">List Rekening</a>
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
      <div class="col-lg-12">
        <form action="{{URL('admin/rekening/tambahRekening')}}" method="post">
          <button type="submit" class="btn btn-default">Tambah Rekening Penerimaan</button>
        </form><hr>
        <table class="table table-striped">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nomor Rekening</th>
                <th>Uraian</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $no => $ini)
                <tr>
                  <td>{{$no+1}}</td>
                  <td>{{$ini->nomor_rekening}}</td>
                  <td>{{$ini->uraian}}</td>
                  <td>
                    <form class="" action="{{URL('admin/rekening/editRekening')}}" method="post">
                        <input type="hidden" name="id" value="{{$ini->id}}">
                        <button type="submit" name="button" class="btn btn-warning">Edit</button>
                    </form>
                    <form class="" action="{{URL('admin/rekening/hapusRekening')}}" method="post">
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
