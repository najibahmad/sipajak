@extends('layouts/dashboard_operator')
@section('title','Control Panel')
@section('dashboard-active',"class=active")
@section('content')
  <div class="container">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Beranda
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> <a href="{{url('admin/dashboard')}}">Beranda</a>
                </li>
            </ol>
        </div>
    </div>

    <a href="{{URL('operator/ketetapanPajak')}}"><button type="button" class="btn btn-default" name="button">Back</button></a>
    <hr>
    <!-- /.row -->
    <form action="{{URL('operator/ketetapanPajak/insertKetetapanPajak')}}" role="form" method="post">
      <div class="form-horizontal">
        <div class="form-group">
          <label class="control-label col-sm-2" for="bulan">Bulan</label>
          <div class="col-sm-10">
            <select class="form-control" id="sel1" name="bulan">
              <option value="Januari">Januari</option>
              <option value="Februari">Februari</option>
              <option value="Maret">Maret</option>
              <option value="April">April</option>
              <option value="Mei">Mei</option>
              <option value="Juni">Juni</option>
              <option value="July">July</option>
              <option value="Agustus">Agustus</option>
              <option value="September">September</option>
              <option value="Oktober">Oktober</option>
              <option value="November">November</option>
              <option value="Desember">Desember</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="tahun">Tahun</label>
          <div class="col-sm-10">
            <select class="form-control" id="sel1" name="tahun">
              <option value="2011">2011</option>
              <option value="2012">2012</option>
              <option value="2013">2013</option>
              <option value="2014">2014</option>
              <option value="2015">2015</option>
              <option value="2016">2016</option>
              <option value="2017">2017</option>
            </select>
          </div>
        </div>
        {{-- <div class="form-group">
          <label class="control-label col-sm-2" for="kecamatan">Kecamatan</label>
          <div class="col-sm-10">
            <select class="form-control" id="sel1" name="kecamatan">
              <option>Silahkan pilih Kecamatan</option>
              @foreach ($kecamatan as $no => $ini)
                <option value="{{$ini->id}}">{{$ini->kecamatan}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="desa">Desa/Kelurahan:</label>
          <div class="col-sm-10">
            <select class="form-control" id="sel1" name="desa">
              <option>Silahkan pilih Desa/Kelurahan</option>
              @foreach ($desa as $no => $ini)
                <option value="{{$ini->id}}">{{$ini->desa}}</option>
              @endforeach
            </select>
          </div>
        </div> --}}
        <div class="form-group">
          <label class="control-label col-sm-2" for="NPWP">NPWP</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="NPWP" id="livesearch" list="datalist" placeholder="search here">
            <datalist id="datalist"></datalist>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="nama">Nama</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="alamat">Alamat</label>
          <div class="col-sm-10">
            <textarea type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat"></textarea>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="jatuhTempo">Jatuh Tempo</label>
          <div class="col-sm-10">
            <input type="text" class="datepicker form-control" id="jatuhTempo" data-provide="datepicker" name="jatuhTempo" placeholder="Jatuh Tempo">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="kodeRekening">Kode Rekening</label>
          <div class="col-sm-10">
            <select class="form-control" id="sel1" name="kodeRekening">
              <option>pilih kode rekening</option>
              @foreach ($rekening as $no => $ini)
                <option value="{{$ini->id}}">{{$ini->nomor_rekening}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="namaKegiatan">Nama Kegiatan/Pekerjaan</label>
          <div class="col-sm-10">
            <textarea type="text" class="form-control" name="namaKegiatan" placeholder="Nama Kegiatan"></textarea>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="keteranganKegiatan">Keterangan Kegiatan</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="keteranganKegiatan" placeholder="keterangan">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="jenisPajak">Jenis Pajak</label>
          <div class="col-sm-10">
            <select class="form-control" id="sel1" name="jenisPajak">
              @foreach ($jenisPajak as $no => $ini)
                <option value="{{$ini->id}}">{{$ini->jenis}}</option>
              @endforeach
            </select>
          </div>
        </div>

      </div>

      <table class="table table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Item</th>
            <th>Volume</th>
            <th>Satuan</th>
            <th>Harga</th>
            <th>Jumlah</th>
          </tr>
        </thead>
        <tbody id="itemKetetapanPajak">
        </tbody>
      <table>

      @if (isset($id))
        <input type="hidden" name="id" value="{{$id}}">
      @endif

      <input type="hidden" name="wajibPajakId" id="wajibPajakId">
      <div class="form-group">
        <hr>
        <button type="submit" class="btn btn-default btn-block">Submit</button>
      </div>
    </form>

  </div>
@endsection

@section('script')
  <script type="text/javascript">
    $(document).ready(function(){

      $('#livesearch').keyup(function(){
        var data=$(this).val();
        $.post("{{url('operator/wajibPajak/getNPWP')}}",{npwp:data},function(result){
          console.log(result);
          $('#datalist').html("");
          $.each(result,function(i, item){
              $('#datalist').append(
                "<option value="+this.npwp+">"+this.npwp+"</option>"
              );
          });
        },"json");
      });

      $('#livesearch').change(function(){
        var data=$(this).val();
        $.post("{{url('operator/wajibPajak/getDataWajibPajak')}}",{npwp:data},function(result){
          console.log(result);
          $("#nama").attr("value",result.nama);
          $("#alamat").attr("value",result.alamat);
          $("#jatuhTempo").attr("value",result.jatuh_tempo);
          $("#wajibPajakId").attr("value",result.id);
        },"json");
        $('#itemKetetapanPajak').html(
          "<tr>\
          <td>1</td>\
          <td><input type=text class=form-control name=namaItem></td>\
          <td><input type=text class=form-control name=volume></td>\
          <td><input type=text class=form-control name=satuan></td>\
          <td><input type=text class=form-control name=harga></td>\
          <td><input type=text class=form-control name=jumlah></td>\
          </tr>"
        );
      });
    });
  </script>
@endsection
