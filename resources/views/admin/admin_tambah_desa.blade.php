@extends('layouts/horizontal_admin')
@section('title','Control Panel')
@section('desa-active',"class=active")
@section('content')
  <div class="container">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Desa
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="{{url('admin/desa')}}">List  Desa</a>
                </li>
                <li class="active">
                    <i class="fa fa-table"></i> <a href="#"> Tambah  Desa</a>
                </li>
            </ol>
        </div>
    </div>
    <a href="{{URL('admin/desa')}}"><button type="button" class="btn btn-default" name="button">Back</button></a>
    <hr>
    <!-- /.row -->
    <form class="form-horizontal" action="{{URL('admin/desa/insertDesa')}}" role="form" method="post">
      <div class="form-group">
        <label class="control-label col-sm-2" for="namaDesa">Desa</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="namaDesa" placeholder="Nama Desa" @if (isset($edit))
            value="{{$edit->desa}}"
          @endif>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="kecamatan">Kecamatan</label>
        <div class="col-sm-4">
          <select class="form-control" id="kecamatan" name="kecamatan">
            <option>Silahkan pilih Kecamatan</option>

            @if (isset($edit))
            @foreach ($kecamatan as $no => $ini)
              @if($ini->id == $edit->kecamatan_id)
                <option value="{{$ini->id}}" selected>{{$ini->kecamatan}}</option>
              @else
                <option value="{{$ini->id}}">{{$ini->kecamatan}}</option>
              @endif
            @endforeach
            @else
            @foreach ($kecamatan as $no => $ini)
                <option value="{{$ini->id}}">{{$ini->kecamatan}}</option>
            @endforeach
            @endif
          </select>
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
