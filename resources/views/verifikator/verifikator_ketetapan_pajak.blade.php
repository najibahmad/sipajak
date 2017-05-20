@extends('layouts/dashboard_verifikator')
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
                <th>Tanggal</th>
                <th>Verifikasi</th>
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
                  <td>{{$ini->created_at}}</td>
                  <td>
                      @if ($ini->status_verifikasi==1)
                        <form class="" action="{{url('verifikator/verifikasiKetetapanPajak/statusVerifikasi')}}" method="post">
                          <input type="hidden" name="id" value="{{$ini->ketetapan_pajak_id}}">
                          <button type="submit" class="btn btn-success" name="button">Verify</button>
                        </form>
                      @elseif($ini->status_verifikasi==2)
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

@section('script')
  <script type="text/javascript">
    $(document).ready(function(){
      $('#getDataKetetapanPajak').keyup(function(){
        var data = $(this).val();
        // console.log(data);
        $.post("{{url('verifikator/verifikasiKetetapanPajak/getDataKetetapanPajak')}}",{npwp:data},function(result){
        console.log(result);
        $('#dataKetetapanPajak').html("");
        $.each(result,function(i,item){
          i=i+1;
          if (this.status_verifikasi==1) {
            var html =
            "<form method=post action={{url('verifikator/verifikasiKetetapanPajak/statusVerifikasi')}}>\
            <input type=hidden name=id value="+this.ketetapan_pajak_id+">\
            <button type=submit class='btn btn-success'>Verify</button>\
            </form>";
          } else if(this.status_verifikasi==2) {
            var html =
            "<h3>Verified</h3>";
          }
          console.log(html);
          $('#dataKetetapanPajak').append(
            "<tr>\
            <td>"+i+"</td>\
            <td>"+this.nama_item+"</td>\
            <td>"+this.npwp+"</td>\
            <td>"+this.jenis+"</td>\
            <td>"+this.volume+"</td>\
            <td>"+this.created_at+"</td>\
            <td>"+html+"\
            </td>\
            </tr>"
          );
        });
        },"json");
      });
    });
  </script>
@endsection
