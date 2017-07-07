@extends('layouts/horizontal_bendahara')
@section('content')
  <div class="container">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Laporan Setoran Bank
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> <a href="{{url('bendahara')}}">Beranda</a>
                </li>
            </ol>
        </div>
    </div>

    <form class="form-horizontal" action="{{URL('bendahara/laporan_setoran/filter')}}" role="form" method="post">

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
<h3>Pemerintah Kabupaten Kerinci</h3>
<h1>BUKU BESAR PEMBANTU</h1>
<h2>Dari tanggal {{$tgl_awal1}} sampai tanggal {{$tgl_akhir1}}</h2>

<!-- Responsive table starts here -->
<!-- For correct display on small screens you must add 'data-title' to each 'td' in your table -->
<div class="table-responsive-vertical shadow-z-1">
<!-- Table starts here -->
<table id="table" border="0" class="table table-hover table-mc-light-blue" style="td:left">
  <tr align="left">
    <td>Urusan Pemerintahan</td>
    <td>:</td>
    <td>1</td>
    <td>Urusan Wajib</td>
  </tr>
  <tr align="left">
    <td>Bidang Pemerintahan</td>
    <td>:</td>
    <td>1.20</td>
    <td>Otonomi Daerah, Pemerintahan Umum, Adm KeuDa, Perangkat Daerah, Kepegawaian</td>
  </tr>
  <tr align="left">
    <td>Unit Organisasi</td>
    <td>:</td>
    <td>1.20.05</td>
    <td>Dinas Pendapatan, Pengelolaan Keuangan dan Aset</td>
  </tr>
  <tr align="left">
    <td>Sub Unit Organisasi</td>
    <td>:</td>
    <td>1.20.05.01</td>
    <td>Dinas Pendapatan, Pengelolaan Keuangan dan Aset</td>
  </tr>
  <tr align="left">
    <td colspan="2">Kode rekening Buku Besar Pembantu</td>
    <td>:</td>
    <td>4.1.2.02.01</td>

  </tr>
  <tr align="left">
    <td colspan="2">Nama rekening Buku Besar Pembantu</td>
    <td>:</td>
    <td>Restribusi Pemakaian Kekayaan Daerah - Penyewaan Tanah dan Bangunan</td>

  </tr>
  <tr align="left">
    <td colspan="2">Pagu APBD</td>
    <td>:</td>
    <td>105.000.000,-</td>

  </tr>
  <tr align="left">
    <td colspan="2">Pagu Perubahan APBD</td>
    <td>:</td>
    <td>130.000.000,-</td>

  </tr>
</table>


<table id="table" class="table table-bordered table-hover table-mc-light-blue">
    <thead>

      <tr>
        <th>NO.</th>
        <th>TANGGAL</th>
        <th>NO. BUKTI</th>

        <th>URAIAN</th>
        <th>DEBET</th>
        <th>KREDIT</th>
        <th>SALDO</th>
      </tr>

    </thead>
    <tbody>
      <?php
      $sum = 0;
      foreach ($laporan as $key => $value):
        $sum = $sum + $value->jumlah_dibayar;
        ?>
        <tr>
          <td>{{$key+1}}</td>
          <td>{{$value->tgl_pembayaran}}</td>
          <td></td>
          <td align="left">{{$value->nama_pekerjaan}}</td>
          <td></td>
          <td align="right">{{ number_format($value->jumlah_dibayar,0) }}</td>
          <td align="right">{{ number_format($sum,0) }}</td>
        </tr>
      <?php endforeach; ?>

    </tbody>
  </table>
</div>


</div>
    @endif


  </div>
@endsection
