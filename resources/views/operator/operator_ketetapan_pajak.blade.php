@extends('layouts/horizontal_operator')
@section('title','Control Panel')
@section('dashboard-active',"class=active")
@section('content')
  <div class="container">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Ketetapan Pajak
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> <a href="{{url('/')}}">Beranda</a>
                </li>
            </ol>
        </div>
    </div>
    <form action="{{URL('operator/ketetapanPajak/tambahKetetapanPajak')}}" method="post">
      <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Ketetapan Pajak</button>
    </form><hr>
      <div class="form-group">
        <label for="cariNPWP">Search NPWD</label>
          <input type="text" class="form-control" name="npwp" placeholder="Search NPWD" id="getDataKetetapanPajak">
      </div>
    <hr>
    <div class="row">
      <div class="col-lg-12">

        <table id="example" class="display" width="100%">
        </table>


        <table class="table table-striped table-bordered table-hover" id="">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama Pekerjaan</th>
                <th>Nama Item</th>
                <th style="min-width:180px;">No NPWD</th>
                <th>Jenis Pajak</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th style="min-width:150px;">Action</th>
                <th>Kirim ke Verifikator</th>
              </tr>
            </thead>
            <tbody id="dataKetetapanPajak">
              <?php $id=0; ?>
              @foreach ($itemKetetapanPajak as $no => $ini)
              <?php
              $npwp = substr($ini->npwp, 0, 2).".".substr($ini->npwp, 2, 3).".".substr($ini->npwp, 5, 3).".".substr($ini->npwp, 8, 1)."-".substr($ini->npwp, 9, 3).".".substr($ini->npwp, 12, 3);
              ?>

                <input type="hidden" name="jenisPajakId" value="{{$ini->jenis_pajak_id}}" id="jenisPajakId">
                <tr>
                  <td>{{$no+1}}</td>
                  <td>{{$ini->nama_pekerjaan}}</td>
                  <td>{{$ini->nama_item}}</td>
                  <td>{{$npwp}}</td>
                  <td>{{$ini->jenis}}</td>
                  <td>{{$ini->volume}}</td>
                  <td>{{$ini->created_at}}</td>
                  <td>
                    <button type="submit" name="button" class="btn btn-warning" onclick="event.preventDefault();document.getElementById('editKetetapanPajak.{{$ini->id}}').submit();">Edit</button>
                    <button type="submit" name="button" class="btn btn-danger" onclick="event.preventDefault();document.getElementById('hapusKetetapanPajak.{{$ini->id}}').submit();">Delete</button>
                    <form id="editKetetapanPajak.{{$ini->id}}" action="{{URL('operator/ketetapanPajak/editKetetapanPajak')}}" method="post">
                        <input type="hidden" name="id" value="{{$ini->id}}">
                    </form>
                    <form id="hapusKetetapanPajak.{{$ini->id}}" action="{{URL('operator/ketetapanPajak/hapusKetetapanPajak')}}" method="post">
                        <input type="hidden" name="id" value="{{$ini->id}}">
                    </form>
                  </td>
                  <?php if($id != $ini->ketetapan_pajak->id){

                    $counts = array_count_values($arr_id);
                    $rows= $counts[$ini->ketetapan_pajak->id];
                    ?>
                  <td style="vertical-align:middle;text-align:center;"  rowspan="{{$rows}}">
                      @if ($ini->status_verifikasi==0)
                        <form class="" action="{{url('operator/ketetapanPajak/statusVerifikasi')}}" method="post">
                          <input type="hidden" name="id" value="{{$ini->ketetapan_pajak->id}}">
                          <button type="submit" class="btn btn-success" name="button">Kirim</button>
                        </form>
                      @elseif($ini->status_verifikasi==1)
                        <h5>Request Sent</h5>
                      @endif
                  </td>
                  <?php }
                  $id = $ini->ketetapan_pajak->id;
                  ?>

                </tr>
              @endforeach
            </tbody>
          </table>

          {{ $itemKetetapanPajak->links() }}
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
        $.post("{{url('operator/ketetapanPajak/getDataKetetapanPajak')}}",{npwp:data},function(result){
        console.log(result);
        $('#dataKetetapanPajak').html("");
        $.each(result,function(i,item){
          i=i+1;
          if (this.status_verifikasi==0) {
            var html =
            "<form method=post action={{url('operator/ketetapanPajak/statusVerifikasi')}}>\
            <input type=hidden name=id value="+this.ketetapan_pajak_id+">\
            <button type=submit class='btn btn-success'>Verify</button>\
            </form>";
          } else if(this.status_verifikasi==1) {
            var html =
            "<h3>Request Sent</h3>";
          }
          console.log(html);

          $('#dataKetetapanPajak').append(
            "<tr>\
            <td>"+i+"</td>\
            <td>"+this.nama_pekerjaan+"</td>\
            <td>"+this.nama_item+"</td>\
            <td>"+this.npwp+"</td>\
            <td>"+this.jenis+"</td>\
            <td>"+this.volume+"</td>\
            <td>"+this.created_at+"</td>\
            <td>\
            <button type=submit class='btn btn-warning' onclick=event.preventDefault();document.getElementById('editKetetapanPajak').submit(); >Edit</button>\
            <button type=submit class='btn btn-danger' onclick=event.preventDefault();document.getElementById('hapusKetetapanPajak').submit(); >Delete</button>\
            <form id=editKetetapanPajak action={{url('operator/ketetapanPajak/editKetetapanPajak')}} method=post>\
              <input type=hidden name=id value="+this.id+">\
            </form>\
            <form id=hapusKetetapanPajak action={{url('operator/ketetapanPajak/hapusKetetapanPajak')}} method=post>\
              <input type=hidden name=id value="+this.id+">\
            </form>\
            </td>\
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
