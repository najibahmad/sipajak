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
                <li>
                    <i class="fa fa-dashboard"></i> <a href="{{url('admin/dashboard')}}">List Rekening</a>
                </li>
                <li class="active">
                    <i class="fa fa-table"></i> <a href="#"> Tambah Rekening</a>
                </li>
            </ol>
        </div>
    </div>
    <a href="{{URL('admin/rekening')}}"><button type="button" class="btn btn-default" name="button">Back</button></a>
    <hr>
    <!-- /.row -->
    <form class="form-horizontal" action="{{URL('admin/rekening/insertRekening')}}" role="form" method="post">
      <div class="form-group">
        <label class="control-label col-sm-2" for="nomorRekening">Nomor Rekening</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="nomorRekening" placeholder="Nomor rekening">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="uraian">Uraian</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="uraian" placeholder="Uraian">
        </div>
      </div>
      <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </form>
  </div>
@endsection
