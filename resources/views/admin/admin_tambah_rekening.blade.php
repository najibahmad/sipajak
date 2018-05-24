@extends('layouts/horizontal_admin')
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
                    <i class="fa fa-dashboard"></i> <a href="{{url('/')}}">List Rekening</a>
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
        <div class="col-sm-6">
          <input type="text" class="form-control" name="nomorRekening" placeholder="Nomor rekening" @if (isset($edit))
            value="{{$edit->nomor_rekening}}"
          @endif>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="uraian">Uraian</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" name="uraian" placeholder="Uraian" @if (isset($edit))
            value="{{$edit->uraian}}"
          @endif>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="jenis_pajak">Jenis Pajak</label>
        <div class="col-sm-4">
          <select class="form-control" id="jenis_pajak" name="jenis_pajak_id">
            <option>Silahkan pilih Jenis Pajak</option>

            @if (isset($edit))
            @foreach ($jenis_pajak as $no => $ini)
              @if($ini->id == $edit->jenis_pajak_id)
                <option value="{{$ini->id}}" selected>{{$ini->jenis}}</option>
              @else
                <option value="{{$ini->id}}">{{$ini->jenis}}</option>
              @endif
            @endforeach
            @else
            @foreach ($jenis_pajak as $no => $ini)
                <option value="{{$ini->id}}">{{$ini->jenis}}</option>
            @endforeach
            @endif
          </select>
        </div>
      </div>
      <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        @if (isset($id))
          <input type="hidden" name="id" value="{{$id}}" class="form-control">
        @endif
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </form>
  </div>
@endsection
