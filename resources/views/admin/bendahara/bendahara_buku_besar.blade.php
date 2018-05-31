@extends('layouts/horizontal_admin')
@section('content')
  <div class="container">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Buku Besar
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> <a href="{{url('admin')}}">Beranda</a>
                </li>
            </ol>
        </div>
    </div>

    <form class="form-horizontal" id="myform" action="{{URL('admin/buku_besar/filter')}}" role="form" method="post">

      <div class="form-group">
        <label class="control-label col-sm-2" for="kecamatan">Kecamatan</label>
        <div class="col-sm-4">
          <select class="form-control" id="kecamatan" name="kecamatan_id">
            <option value="0">Semua Kecamatan</option>
            @foreach ($kecamatan as $no => $ini)
              @if(isset($kecamatan_id) && $kecamatan_id == $ini->id)
                <option value="{{$ini->id}}" selected>{{$ini->kecamatan}}</option>
              @else
                <option value="{{$ini->id}}">{{$ini->kecamatan}}</option>
              @endif  
            @endforeach

          </select>
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="jenis_pajak">Jenis Pajak</label>
        <div class="col-sm-4">
          <select class="form-control" id="jenis_pajak" name="jenis_pajak_id">
            @foreach ($jenis_pajak as $no => $ini)
              @if(isset($jenis_pajak_id) && $jenis_pajak_id == $ini->id)
                <option value="{{$ini->id}}" selected>{{$ini->jenis}}</option>
              @else  
                <option value="{{$ini->id}}">{{$ini->jenis}}</option>
              @endif
            @endforeach

          </select>
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="kecamatan">Dari Tanggal:</label>
        <div class="col-sm-3">
          <input value="@if(isset($tgl_awal)) {{$tgl_awal}} @endif" type="text" class="datepicker form-control" data-provide="datepicker" name="tgl_awal" placeholder="Tanggal Awal"
          autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"
          required/>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="kecamatan">Dari Tanggal:</label>
        <div class="col-sm-3">
          <input value="@if(isset($tgl_akhir)) {{$tgl_akhir}} @endif"  type="text" class="datepicker form-control" data-provide="datepicker" name="tgl_akhir" placeholder="Tanggal Akhir" 
          autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" required/>
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
<h4>Pemerintah Kabupaten Kerinci</h4>
<h3>BUKU BESAR PEMBANTU</h3>
<h5>Dari tanggal {{$tgl_awal1}} sampai tanggal {{$tgl_akhir1}}</h5>

<!-- Responsive table starts here -->
<!-- For correct display on small screens you must add 'data-title' to each 'td' in your table -->
<div class="">
<!-- Table starts here -->
<table id="table" border="0" class="table" width="" style="text-align: left;">
  
  <tr>
    <td width="25%">Kode rekening Buku Besar Pembantu</td>
    <td width="2%">:</td>
    <td>{{$nomor_rekening}}</td>

  </tr>
  <tr>
    <td>Nama rekening Buku Besar Pembantu</td>
    <td>:</td>
    <td style="text-align: left;">{{$buku_besar}}</td>

  </tr>
  
</table>


<table id="table" class="table table-bordered table-hover table-mc-light-blue">
    <thead>



      <tr>
        <th rowspan="2">NO.</th>
        <th rowspan="2">TANGGAL</th>
        <th colspan="3" style="text-align: center;">REFERENSI</th>

        <th rowspan="2">URAIAN</th>
        
        <th rowspan="2">JUMLAH</th>
        <th rowspan="2">SALDO</th>
      </tr>
      <tr>
        <th>NPWD</th>
        <th>NOMOR SKPD</th>
        <th>STBP</th>
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
          <td>{{$value->npwp}}</td>
          <td>{{$value->nomor_bukti}}</td>
          <td>{{ sprintf('%04d', $value->nomor_pembayaran)}}</td>
          <td align="left">{{$value->nama_pekerjaan}}</td>
          
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


@section('script')
<script src="{{URL($default_url.'js/jquery.validate.min.js')}}"></script>
<script src="{{URL($default_url.'js/additional-methods.js')}}"></script>
  <script type="text/javascript">


    $(document).ready(function () {

      $('#myform').validate({ // initialize the plugin
          rules: {
              tgl_awal: {
                  required: true,
              },
              tgl_akhir: {
                  required: true,
              },
              
          }
          
      });

  });

   
  </script>


@endsection

