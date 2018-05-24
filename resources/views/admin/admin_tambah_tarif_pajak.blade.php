@extends('layouts/horizontal_admin')
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
                <li>
                    <i class="fa fa-dashboard"></i> <a href="{{url('/')}}">List Tarif Pajak</a>
                </li>
                <li class="active">
                    <i class="fa fa-table"></i> <a href="#"> Tambah Tarif Pajak</a>
                </li>
            </ol>
        </div>
    </div>
    <a href="{{URL('admin/tarif')}}"><button type="button" class="btn btn-default" name="button">Back</button></a>
    <hr>
    <!-- /.row -->
    <form class="form-horizontal" action="{{URL('admin/tarif/insertTarifPajak')}}" role="form" method="post">
      <div class="form-group">
        <label class="control-label col-sm-2" for="namaItem">Nama Item</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="namaItem" placeholder="Nama Item" @if (isset($edit))
            value="{{$edit->nama_item}}"
          @endif>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="uraian">Jenis</label>
        <div class="col-sm-2">
            <select class="form-control" name="jenisPajakId">
              @foreach ($jenisPajak as $no => $ini)
                <option value="{{$ini->id}}">{{$ini->jenis}}</option>
              @endforeach
            </select>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="satuan">Satuan</label>
        <div class="col-sm-2">
          <input type="text" class="form-control" name="satuan" placeholder="Satuan" @if (isset($edit))
            value="{{$edit->satuan}}"
          @endif>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="tarif">Tarif</label>
        <div class="col-sm-3">
          <input type="text" class="form-control" name="tarif" placeholder="Tarif" @if (isset($edit))
            value="{{$edit->tarif}}"
          @endif>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="tahun">Tahun</label>
        <div class="col-sm-1">
            <select class="form-control" name="tahun">
              @for ($i = 0; $i < count($tahun); $i++)
                @if (isset($edit) && $edit->tahun == $tahun[$i])
                  <option value="{{$tahun[$i]}}" selected>{{$tahun[$i]}}</option>  
                @endif
                <option value="{{$tahun[$i]}}">{{$tahun[$i]}}</option>
              @endfor
              
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
