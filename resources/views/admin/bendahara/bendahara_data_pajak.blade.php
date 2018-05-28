@extends('layouts/horizontal_admin')
@section('content')
  <div class="container">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Beranda
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> <a href="{{url('/')}}">Beranda</a>
                </li>
            </ol>
        </div>
    </div>
      
    <hr>
    <div class="row">
      <div class="col-lg-12">
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>No NPWD</th>
                <th>Nama Pekerjaan</th>
                <th>Jenis Pajak</th>
                <th>Jumlah</th>


                <th style="min-width:100px">Jatuh Tempo</th>
                <th>Pembayaran</th>
                <th>Status Pembayaran</th>
                <th>Cetak STBP</th>
                <th>Cetak Setoran Bank</th>
              </tr>
            </thead>
            <tbody id="dataKetetapanPajak">
              @foreach ($ketetapanPajak as $no => $ini)
              <?php
              $npwp = substr($ini->npwp, 0, 2).".".substr($ini->npwp, 2, 3).".".substr($ini->npwp, 5, 3).".".substr($ini->npwp, 8, 1)."-".substr($ini->npwp, 9, 3).".".substr($ini->npwp, 12, 3);

              ?>
                <input type="hidden" name="jenisPajakId" value="{{$ini->jenis_pajak_id}}" id="jenisPajakId">
                <tr>
                  <td>{{$no+1}}</td>
                  <td>{{$ini->nama}}</td>
                  <td style="min-width:170px;">{{$npwp}}</td>
                  <td>{{$ini->nama_pekerjaan}}</td>
                  <td>{{$ini->jenis}}</td>
                  <td>{{$ini->jumlah}}</td>



                  <td>{{$ini->jatuh_tempo}}</td>
                  <td>{{$ini->tgl_pembayaran}}</td>
                  <td>
                      @if ($ini->status_pembayaran==0)
                        <form  action="{{url('admin/dataPajak/statusPembayaran')}}" method="post">
                          <input type="hidden" name="id" value="{{$ini->id_ketetapan}}">
                          <button type="submit" class="btn btn-warning" name="button">Bayar</button>
                        </form>
                      @elseif($ini->status_pembayaran==1)
                        <h5>Sudah Membayar</h5>
                      @endif
                  </td>
                  <td>

                    @if($ini->status_pembayaran==0)
                      <h5>Belum bisa Cetak</h5>
                    @elseif($ini->status_pembayaran==1)
                    <a type="button" href="{{ route('admincetak_stbp',['download'=>'pdf', 'id'=>$ini->id_ketetapan] ) }}" class="btn"> <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Cetak</a>
                    @endif
                  </td>
                  <td>

                    @if($ini->status_pembayaran==0)
                      <h5>Belum bisa Cetak</h5>
                    @elseif($ini->status_pembayaran==1)
                    <a type="button" href="{{ route('admincetak_setoranbank',['download'=>'pdf', 'id'=>$ini->id_ketetapan] ) }}" class="btn"> <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Cetak</a>
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
        var data = $('#livesearch').val();
        // console.log(data);
        $.post("{{url('admin/dataPajak/getDataKetetapanPajak')}}",{npwp:data},function(result){
        console.log(result);
        $('#dataKetetapanPajak').html("");
        $.each(result,function(i,item){
          i=i+1;
          if (this.status_pembayaran==0) {
            var html =
            "<form method=post action={{url('admin/dataPajak/statusPembayaran')}}>\
            <input type=hidden name=id value="+this.ketetapan_pajak_id+">\
            <button type=submit class='btn btn-warning'>Bayar</button>\
            </form>";
          } else if(this.status_pembayaran==1) {
            var html =
            "<h5>Sudah membayar</h5>";
          }
          if(this.status_pembayaran==0){
            var stbp =
            "<h5>Belum bisa cetak</h5>";
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
