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
    <form action="{{URL('operator/ketetapanPajak/tambahKetetapanPajak')}}" method="post">
      <button type="submit" class="btn btn-default">Tambah Ketetapan Pajak</button>
    </form><hr>
    <form action="{{URL('admin/pajak/insertJenisPajak')}}" role="form" method="post">
      <div class="form-group">
        <label for="namaJenisPajak">Nama</label>
          <input type="text" class="form-control" name="nama" placeholder="Search nama">
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </form>
    <hr>
    <div class="row">
      <div class="col-lg-12">
        <table class="table table-striped">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>No NPWP</th>
                <th>Jenis Pajak</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Action</th>
                <th>Kirim ke Verifikator</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($itemKetetapanPajak as $no => $ini)
                <input type="hidden" name="jenisPajakId" value="{{$ini->jenis_pajak_id}}" id="jenisPajakId">
                <tr>
                  <td>{{$no+1}}</td>
                  <td>{{$ini->nama_item}}</td>
                  <td>{{$ini->npwp}}</td>
                  <td>{{$ini->jenis}}</td>
                  <td>{{$ini->volume}}</td>
                  <td>{{$ini->created_at}}</td>
                  <td>
                    <form action="{{URL('operator/ketetapanPajak/editKetetapanPajak')}}" method="post">
                        <input type="hidden" name="id" value="{{$ini->ketetapan_pajak_id}}">
                        <button type="submit" name="button" class="btn btn-warning">Edit</button>
                    </form>
                    <form action="{{URL('operator/ketetapanPajak/hapusKetetapanPajak')}}" method="post">
                        <input type="hidden" name="id" value="{{$ini->ketetapan_pajak_id}}">
                        <button type="submit" name="button" class="btn btn-danger">Delete</button>
                    </form>
                  </td>
                  <td>
                      @if ($ini->status_verifikasi==0)
                        <form class="" action="{{url('operator/ketetapanPajak/statusVerifikasi')}}" method="post">
                          <input type="hidden" name="id" value="{{$ini->ketetapan_pajak_id}}">
                          <button type="submit" class="btn btn-success" name="button">Verify</button>
                        </form>
                      @else
                        <h3>Verified</h3>
                      @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
      </div>
    </div>

  </div>
@endsection
