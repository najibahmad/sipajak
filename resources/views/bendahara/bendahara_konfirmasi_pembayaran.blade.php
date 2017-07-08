@extends('layouts/horizontal_bendahara')
@section('content')
  <div class="container">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Konfirmasi Pembayaran Pajak
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> <a href="{{url('bendahara')}}">Beranda</a>
                </li>
            </ol>
        </div>
    </div>




    <div id="demo" style="text-align:center;padding-top:10px;">
<h3>Pemerintah Kabupaten Kerinci</h3>
<h1>KETETAPAN PAJAK</h1>


<!-- Responsive table starts here -->
<!-- For correct display on small screens you must add 'data-title' to each 'td' in your table -->
<div class="table-responsive-vertical shadow-z-1">
<!-- Table starts here -->
<table id="table" border="0" class="table table-hover table-mc-light-blue" style="td:left">
  <?php
  $temp = $ketetapanPajak->wajib_pajak->npwp;
  $npwp = substr($temp, 0, 2).".".substr($temp, 2, 3).".".substr($temp, 5, 3).".".substr($temp, 8, 1)."-".substr($temp, 9, 3).".".substr($temp, 12, 3);

  ?>
  <tr align="left">
    <td>Nomor Pembayaran</td>
    <td>:</td>
    <td>{{ sprintf('%04d', $nomor) }}</td>

  </tr>
  <tr align="left">
    <td>Wajib Pajak</td>
    <td>:</td>
    <td>{{ $ketetapanPajak->wajib_pajak->nama }}</td>

  </tr>
  <tr align="left">
    <td>NPWP</td>
    <td>:</td>
    <td>{{ $npwp }}</td>

  </tr>
  <tr align="left">
    <td>Nama Pekerjaan</td>
    <td>:</td>
    <td>{{ $ketetapanPajak->nama_pekerjaan }}</td>

  </tr>
  <tr align="left">
    <td>Jatuh Tempo</td>
    <td>:</td>
    <td>{{ $ketetapanPajak->jatuh_tempo }}</td>

  </tr>

</table>


<table id="table" class="table table-bordered table-hover table-mc-light-blue">
    <thead>

      <tr>
        <th>NO.</th>
        <th>ITEM</th>
        <th>VOLUME</th>

        <th>SATUAN</th>
        <th>HARGA</th>

      </tr>

    </thead>
    <tbody>
      <?php
      $sum = 0;
      foreach ($itemKetetapanPajak as $key => $value):
        $sum = $sum + $value->harga;
        ?>
        <tr>
          <td>{{$key+1}}</td>
          <td>{{$value->nama_item}}</td>
          <td>{{$value->volume}}</td>
          <td>{{$value->satuan}}</td>
          <td align="right">{{ number_format($value->harga,0) }}</td>
        </tr>
      <?php endforeach; ?>
      <tr>
        <td colspan="4" align="center"> TOTAL </td>
        <td align="right">{{ number_format($sum,0) }}</td>
      </tr>
    </tbody>
  </table>

  <form  action="{{url('bendahara/dataPajak/prosesPembayaran')}}" method="post">
    <input type="hidden" name="id" value="{{$ketetapanPajak->id}}">
    <input type="hidden" name="nomor" value="{{$nomor}}">
    <input type="hidden" name="nomor_bukti" value="{{$nomor_bukti}}">
    <input type="text" name="jumlah_dibayar"><br><br>
    <button type="submit" class="btn btn-warning" name="button">Bayar</button>
  </form>

</div>


</div>


  </div>
@endsection
