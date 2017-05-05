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
    <form class="form-horizontal" action="{{URL('operator/ketetapanPajak/insertKetetapanPajak')}}" role="form" method="post">
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
      <div class="form-group">
        <label class="control-label col-sm-2" for="nama">Nama</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="nama" placeholder="Nama">
        </div>
      </div>
      <div class="form-group">
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
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="alamat">Alamat</label>
        <div class="col-sm-10">
          <textarea type="text" class="form-control" name="alamat" placeholder="Alamat"></textarea>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="NPWP">NPWP</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="NPWP" placeholder="NPWP">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="jatuhTempo">Jatuh Tempo</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="jatuhTempo" placeholder="Jatuh Tempo">
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

      <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </form>

  </div>
@endsection
