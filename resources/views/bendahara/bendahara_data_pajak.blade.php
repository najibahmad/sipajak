@extends('layouts/dashboard_bendahara')
@section('content')
  <div class="container-fluid">

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
      <div class="form-group">
        <label for="cariNPWP">Search NPWP</label>
          <input type="text" class="form-control" name="npwp" placeholder="Search NPWP" id="getDataKetetapanPajak">
      </div>
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
                <th>Alamat</th>
                <th>Tanggal</th>
                <th>Status Pembayaran</th>
                <th>Cetak STBP</th>
                <th>Cetak Setoran Bank</th>
              </tr>
            </thead>
            <tbody id="dataKetetapanPajak">
              @foreach ($itemKetetapanPajak as $no => $ini)
                <input type="hidden" name="jenisPajakId" value="{{$ini->jenis_pajak_id}}" id="jenisPajakId">
                <tr>
                  <td>{{$no+1}}</td>
                  <td>{{$ini->nama_item}}</td>
                  <td>{{$ini->npwp}}</td>
                  <td>{{$ini->jenis}}</td>
                  <td>{{$ini->volume}}</td>
                  <td>{{$ini->alamat}}</td>
                  <td>{{$ini->created_at}}</td>
                  <td>
                      @if ($ini->status_pembayaran==0)
                        <form  action="{{url('bendahara/dataPajak/statusPembayaran')}}" method="post">
                          <input type="hidden" name="id" value="{{$ini->ketetapan_pajak_id}}">
                          <button type="submit" class="btn btn-warning" name="button">Bayar</button>
                        </form>
                      @elseif($ini->status_pembayaran==1)
                        <h4>Sudah Membayar</h4>
                      @endif
                  </td>
                  <td>
                    @if($ini->status_pembayaran==0)
                      <h4>Belum bisa Cetak</h4>
                    @elseif($ini->status_pembayaran==1)
                      <button type="button" name="button" class="btn btn-info">Cetak</button>
                    @endif
                  </td>
                  <td>
                    <button type="button" class="btn btn-success" name="button">Cetak</button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
      </div>
    </div>

  </div>
@endsection

@section('script')
  <script type="text/javascript">
    $(document).ready(function(){
      $('#getDataKetetapanPajak').keyup(function(){
        var data = $(this).val();
        // console.log(data);
        $.post("{{url('bendahara/dataPajak/getDataKetetapanPajak')}}",{npwp:data},function(result){
        console.log(result);
        $('#dataKetetapanPajak').html("");
        $.each(result,function(i,item){
          i=i+1;
          if (this.status_pembayaran==0) {
            var html =
            "<form method=post action={{url('bendahara/dataPajak/statusPembayaran')}}>\
            <input type=hidden name=id value="+this.ketetapan_pajak_id+">\
            <button type=submit class='btn btn-warning'>Bayar</button>\
            </form>";
          } else if(this.status_pembayaran==1) {
            var html =
            "<h4>Sudah membayar</h4>";
          }
          if(this.status_pembayaran==0){
            var stbp =
            "<h4>Belum bisa cetak</h4>";
          } else if(this.status_pembayaran==1){
            var stbp =
            "<button type=button class='btn btn-info'>Cetak</button>";
          }
          console.log(html);
          $('#dataKetetapanPajak').append(
            "<tr>\
            <td>"+i+"</td>\
            <td>"+this.nama_item+"</td>\
            <td>"+this.npwp+"</td>\
            <td>"+this.jenis+"</td>\
            <td>"+this.volume+"</td>\
            <td>"+this.alamat+"</td>\
            <td>"+this.created_at+"</td>\
            <td>"+html+"\
            </td>\
            <td>"+stbp+"\
            </td>\
            <td>\
            <form>\
            <button type=button class='btn btn-success' name=button>Cetak</button>\
            </form>\
            </td>\
            </tr>"
          );
        });
        },"json");
      });
    });
  </script>
@endsection
