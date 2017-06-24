@extends('layouts/dashboard_bendahara')
@section('content')
  <div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Laporan Pembayaran Pajak
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> <a href="{{url('bendahara')}}">Beranda</a>
                </li>
            </ol>
        </div>
    </div>

    <form class="form-horizontal" action="{{URL('operator/wajibPajak/insertWajibPajak')}}" role="form" method="post">
      
      <div class="form-group">
        <label class="control-label col-sm-2" for="kecamatan">Kecamatan</label>
        <div class="col-sm-10">
          <select class="form-control" id="kecamatan" name="kecamatan">
            <option>Silahkan pilih Kecamatan</option>


            @foreach ($kecamatan as $no => $ini)
                <option value="{{$ini->id}}">{{$ini->kecamatan}}</option>
            @endforeach

          </select>
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="kecamatan">Dari Tanggal:</label>
        <div class="col-sm-10">
          <input type="text" class="datepicker form-control" data-provide="datepicker" name="tgl_awal" placeholder="Tanggal Awal"
          >
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="kecamatan">Dari Tanggal:</label>
        <div class="col-sm-10">
          <input type="text" class="datepicker form-control" data-provide="datepicker" name="tgl_akhir" placeholder="Tanggal Akhir">
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
