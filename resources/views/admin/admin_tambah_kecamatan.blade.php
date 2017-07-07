@extends('layouts/horizontal_admin')
@section('title','Control Panel')
@section('kecamatan-active',"class=active")
@section('content')
  <div class="container">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Kecamatan
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="{{url('admin/kecamatan')}}">List  Kecamatan</a>
                </li>
                <li class="active">
                    <i class="fa fa-table"></i> <a href="#"> Tambah  Kecamatan</a>
                </li>
            </ol>
        </div>
    </div>
    <a href="{{URL('admin/kecamatan')}}"><button type="button" class="btn btn-default" name="button">Back</button></a>
    <hr>
    <!-- /.row -->
    <form class="form-horizontal" action="{{URL('admin/kecamatan/insertKecamatan')}}" role="form" method="post">
      <div class="form-group">
        <label class="control-label col-sm-2" for="namaKecamatan">Kecamatan</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="namaKecamatan" placeholder="Nama Kecamatan" @if (isset($edit))
            value="{{$edit->kecamatan}}"
          @endif>
        </div>
      </div>
      @if (isset($id))
        <input type="hidden" name="id" value="{{$id}}">
      @endif
      <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </form>
  </div>
@endsection
