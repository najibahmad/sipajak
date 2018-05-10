@extends('layouts/horizontal_operator')
@section('content')
  <div class="container">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Laporan Pembayaran Pajak
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> <a href="{{url('operator')}}">Beranda</a>
                </li>
            </ol>
        </div>
    </div>

    <form class="form-horizontal" action="{{URL('operator/laporan/filter')}}" role="form" method="post">

      <div class="form-group">
        <label class="control-label col-sm-2" for="kecamatan">Kecamatan</label>
        <div class="col-sm-4">
          <select class="form-control" id="kecamatan" name="kecamatan">
            <option value="0">Semua Kecamatan</option>


            @foreach ($kecamatan as $no => $ini)
                <option value="{{$ini->id}}">{{$ini->kecamatan}}</option>
            @endforeach

          </select>
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="kecamatan">Dari Tanggal:</label>
        <div class="col-sm-3">
          <input value="@if(isset($tgl_awal)) {{$tgl_awal}} @endif" type="text" class="datepicker form-control" data-provide="datepicker" name="tgl_awal" placeholder="Tanggal Awal"
          >
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="kecamatan">Dari Tanggal:</label>
        <div class="col-sm-3">
          <input value="@if(isset($tgl_akhir)) {{$tgl_akhir}} @endif"  type="text" class="datepicker form-control" data-provide="datepicker" name="tgl_akhir" placeholder="Tanggal Akhir">
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

    @if(isset($filter))
    <div id="demo" style="text-align:center;padding-top:10px;">
<h1>Laporan Bulanan Pajak</h1>
<h2>Dari tanggal {{$tgl_awal1}} sampai tanggal {{$tgl_akhir1}}</h2>

<!-- Responsive table starts here -->
<!-- For correct display on small screens you must add 'data-title' to each 'td' in your table -->
<div class="table-responsive-vertical shadow-z-1">
<!-- Table starts here -->
<table id="table" class="table table-bordered table-hover table-mc-light-blue">
    <thead>
      <tr>
        <th rowspan="2" >NO</th>
        <th rowspan="2">URAIAN</th>
        <th colspan="3">SKP</th>
        <th colspan="3">STBP</th>
        <th rowspan="2">SELISIH</th>
        <th rowspan="2">KET</th>
      </tr>
      <tr>
        <th>NOMOR</th>
        <th>TANGGAL</th>
        <th>JUMLAH</th>

        <th>NOMOR</th>
        <th>TANGGAL PEMBAYARAN</th>
        <th>JUMLAH</th>
      </tr>
      <tr>
        <th>1</th>
        <th>2</th>
        <th>3</th>

        <th>4</th>
        <th>5</th>
        <th>6</th>
        <th>7</th>
        <th>8</th>
        <th>9</th>
        <th>10</th>

      </tr>
    </thead>
    <tbody>
      <?php foreach ($laporan as $key => $value): ?>
        <tr>
          <td>{{$key+1}}</td>
          <td align="left">{{$value->nama_pekerjaan}}</td>
          <td>{{ sprintf('%04d', $value->nomor_skp)}}</td>

          <td>{{$value->jatuh_tempo}}</td>
          <td  align="right">{{ number_format($value->jumlah,0)}}</td>
          <td>{{ sprintf('%04d', $value->nomor_pembayaran)}}</td>
          <td>{{$value->tgl_pembayaran}}</td>
          <td  align="right">{{ number_format($value->jumlah_dibayar,0) }}</td>
          <td  align="right">{{ number_format($value->jumlah - $value->jumlah_dibayar,0)}}</td>
          <td></td>
        </tr>
      <?php endforeach; ?>

    </tbody>
  </table>
</div>


</div>
    @endif


  </div>
@endsection
