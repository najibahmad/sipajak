@extends('layouts/horizontal_admin')
@section('content')
  <div class="container">

    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                Verifikasi Ketetapan Pajak
            </h3>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> <a href="{{url('/')}}">Beranda</a>
                </li>
            </ol>
        </div>
    </div>
      <div class="form-group">
        <div class="col-md-1">
        <label for="cariNPWP"> NPWD</label>
        </div>

        <div class="col-md-4">
          <input type="text" class="form-control" name="npwp" placeholder="Search NPWD" id="livesearch" list="datalist" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
        </div>
        <br>
          <datalist id="datalist"></datalist>
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
                <th>Jenis Pajak</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Verifikasi</th>
              </tr>
            </thead>
            <tbody id="dataKetetapanPajak">
              <?php $id=0; ?>
              @foreach ($itemKetetapanPajak as $no => $ini)
                <input type="hidden" name="jenisPajakId" value="{{$ini->jenis_pajak_id}}" id="jenisPajakId">
                <tr>
                  <td>{{$no+1}}</td>
                  <td>{{$ini->nama_item}}</td>
                  <td>{{$ini->npwp}}</td>
                  <td>{{$ini->jenis}}</td>
                  <td>{{$ini->volume}}</td>
                  <td>{{$ini->created_at}}</td>
                  <!-- <?php if($id != $ini->ketetapan_pajak->id){

                    $counts = array_count_values($arr_id);
                    $rows= $counts[$ini->ketetapan_pajak->id];
                    ?> -->
                  <td style="vertical-align:middle;text-align:center;" >
                      @if ($ini->status_verifikasi==1)
                        <form class="" action="{{url('admin/verifikasiKetetapanPajak/statusVerifikasi')}}" method="post">
                          <input type="hidden" name="id" value="{{$ini->ketetapan_pajak_id}}">
                          <button type="submit" class="btn btn-success" name="button">Verifikasi</button>
                        </form>
                      @elseif($ini->status_verifikasi==2)
                        <h5>Sudah di Verifikasi</h5>
                      @endif
                  </td>
                  <?php }
                  $id = $ini->ketetapan_pajak->id;
                  ?>
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
        //alert(data);
        $.post("{{url('admin/verifikasiKetetapanPajak/getNPWP')}}",{npwp:data},function(result){
          console.log(result);
          $('#datalist').html("");
          $.each(result,function(i, item){
              $('#datalist').append(
                "<option value="+this.npwp+">"+this.npwp+" : "+this.nama+"</option>"
              );
          });
        },"json");
      });

      $('#livesearch').change(function(){

        var data = $(this).val();
        // console.log(data);
        $.post("{{url('admin/verifikasiKetetapanPajak/getDataKetetapanPajak')}}",{npwp:data},function(result){
        console.log(result);
        $('#dataKetetapanPajak').html("");
        $.each(result,function(i,item){
          i=i+1;
          if (this.status_verifikasi==1) {
            var html =
            "<form method=post action={{url('admin/verifikasiKetetapanPajak/statusVerifikasi')}}>\
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
