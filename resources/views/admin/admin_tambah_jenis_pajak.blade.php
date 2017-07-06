@extends('layouts/horizontal_admin')
@section('title','Control Panel')
@section('pajak-active',"class=active")
@section('content')
  <div class="container">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Jenis Pajak
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="{{url('admin/dashboard')}}">List Jenis Pajak</a>
                </li>
                <li class="active">
                    <i class="fa fa-table"></i> <a href="#"> Tambah Jenis Pajak</a>
                </li>
            </ol>
        </div>
    </div>
    <a href="{{URL('admin/pajak')}}"><button type="button" class="btn btn-default" name="button">Back</button></a>
    <hr>
    <!-- /.row -->
    <form class="form-horizontal" action="{{URL('admin/pajak/insertJenisPajak')}}" role="form" method="post">
      <div class="form-group">
        <label class="control-label col-sm-2" for="namaJenisPajak">Nama Jenis Pajak</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="namaJenisPajak" placeholder="Nama Jenis Pajak" @if (isset($edit))
            value="{{$edit->jenis}}"
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
