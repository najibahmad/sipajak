@extends('layouts/horizontal_operator')
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
              @if (isset($edit))
              @for ($i = 0; $i < 10; $i++)
                  @if($bulan[$i]==$edit->bulan)
                    <option value="{{$bulan[$i]}}" selected>{{$bulan[$i]}}</option>
                  @else
                    <option value="{{$bulan[$i]}}">{{$bulan[$i]}}</option>
                  @endif
              @endfor
              @else
                @for ($i = 0; $i < 10; $i++)
                  <option value="{{$bulan[$i]}}">{{$bulan[$i]}}</option>
                @endfor
              @endif



            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="tahun">Tahun</label>
          <div class="col-sm-10">
            <select class="form-control" id="sel1" name="tahun">
              @if (isset($edit))
                @for ($i = 0; $i < count($tahun); $i++)
                    @if($tahun[$i]==$edit->tahun)
                      <option value="{{$tahun[$i]}}" selected>{{$tahun[$i]}}</option>
                    @else
                      <option value="{{$tahun[$i]}}">{{$tahun[$i]}}</option>
                    @endif
                @endfor
              @else
                <option value="{{$tahun[$i]}}">{{$tahun[$i]}}</option>
              @endif

            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="NPWP">NPWP</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="NPWP" id="livesearch" list="datalist" placeholder="search here"@if (isset($edit))
              value="{{$edit->npwp}}"
            @endif>
            <datalist id="datalist"></datalist>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="nama">Nama</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" @if (isset($edit))
              value="{{$edit->nama}}"
            @endif>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="alamat">Alamat</label>
          <div class="col-sm-10">
            <textarea type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat">@if (isset($edit)){{$edit->alamat}}
            @endif</textarea>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="jatuhTempo">Jatuh Tempo</label>
          <div class="col-sm-10">
            <input type="text" class="datepicker form-control" id="jatuhTempo" data-provide="datepicker" name="jatuhTempo" placeholder="Jatuh Tempo" @if (isset($edit))
              value="{{$edit->jatuh_tempo}}"
            @endif>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="kodeRekening">Kode Rekening</label>
          <div class="col-sm-10">
            <select class="form-control" id="sel1" name="kodeRekening">
              <option>pilih kode rekening</option>


              @if (isset($edit))
                  @foreach ($rekening as $no => $ini)
                    @if($ini->id == $edit->rekening_penerimaan_id)
                      <option value="{{$ini->id}}" selected>{{$ini->nomor_rekening}}</option>
                    @else
                      <option value="{{$ini->id}}">{{$ini->nomor_rekening}}</option>
                    @endif
                  @endforeach
              @else
              @foreach ($rekening as $no => $ini)
                <option value="{{$ini->id}}">{{$ini->nomor_rekening}}</option>
                @endforeach
              @endif

            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="namaKegiatan">Nama Kegiatan/Pekerjaan</label>
          <div class="col-sm-10">
            <textarea type="text" class="form-control" name="namaKegiatan" placeholder="Nama Kegiatan">@if (isset($edit)){{$edit->nama_pekerjaan}}@endif</textarea>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="keteranganKegiatan">Keterangan Kegiatan</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="keteranganKegiatan" placeholder="keterangan" @if (isset($edit))
              value="{{$edit->keterangan_pekerjaan}}"
            @endif)>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="jenisPajak">Jenis Pajak</label>
          <div class="col-sm-10">
            <select class="form-control" id="sel1" name="jenisPajak">


              @if (isset($edit))
                @foreach ($jenisPajak as $no => $ini)
                  @if($ini->id == $edit->jenis_pajak_id)
                    <option value="{{$ini->id}}" selected>{{$ini->jenis}}</option>
                  @else
                    <option value="{{$ini->id}}">{{$ini->jenis}}</option>
                  @endif

                @endforeach
              @else
              @foreach ($jenisPajak as $no => $ini)

                  <option value="{{$ini->id}}">{{$ini->jenis}}</option>

              @endforeach
              @endif
            </select>
          </div>
        </div>

      </div>

      <table class="table table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Item</th>
            <th>Jumlah</th>
            <th>Satuan</th>
            <th>Harga</th>
          </tr>
        </thead>
        <tbody id="itemKetetapanPajak">
        </tbody>
      <table>
      <div class="row">
        <div class="col-sm-6">
          <div id="addItem"></div>
        </div>
        <div class="col-sm-6">
          <div id="removeItem"></div>
        </div>
      </div>
      <div id="totalItem"></div>

      {{-- {{dd($id)}} --}}
      @if (isset($id))
        <input type="hidden" name="id" id="updateId" value="{{$id}}">
      @endif

      <input type="hidden" name="wajibPajakId" id="wajibPajakId">
      <div class="form-group">
        <hr>
        <button type="submit" class="btn btn-success btn-block">Submit</button>
      </div>
    </form>

  </div>
@endsection

@section('script')
  <script type="text/javascript">
    $(document).ready(function(){

      var i=1;
      $("#totalItem").html(
        "<input type=hidden name=totalItem value="+i+">"
      );

      $('#livesearch').keyup(function(){
        var data=$(this).val();
        $.post("{{url('operator/wajibPajak/getNPWP')}}",{npwp:data},function(result){
          console.log(result);
          $('#datalist').html("");
          $.each(result,function(i, item){
              $('#datalist').append(
                "<option value="+this.npwp+">"+this.npwp+" : "+this.nama+"</option>"
              );
          });
        },"json");
      });

      @if (isset($id))
      var data = {{$edit->npwp}};
      $.post("{{url('operator/wajibPajak/getDataWajibPajak')}}",{npwp:data},function(result){
        console.log(result);
        $("#nama").attr("value",result.nama);
        $("#alamat").attr("value",result.alamat);
        $("#jatuhTempo").attr("value",result.jatuh_tempo);
        $("#wajibPajakId").attr("value",result.id);
      },"json");

          $.post("{{url('operator/ketetapanPajak/getEditData')}}",{id:$("#updateId").val()},function(data){
            console.log(data);
            $('#itemKetetapanPajak').html(
              "<tr>\
              <td>1</td>\
              <td><input type=text class=form-control name=namaItem value="+data.nama_item+"></td>\
              <td><input type=text class=form-control name=volume value="+data.volume+"></td>\
              <td><input type=text class=form-control name=satuan value="+data.satuan+"></td>\
              <td><input type=text class=form-control name=harga value="+data.harga+"></td>\
              </tr>"
            );
          },"json");
      @endif

      $('#livesearch').change(function(){

        var data=$(this).val();
        $.post("{{url('operator/wajibPajak/getDataWajibPajak')}}",{npwp:data},function(result){
          console.log(result);
          $("#nama").attr("value",result.nama);
          $("#alamat").attr("value",result.alamat);
          $("#jatuhTempo").attr("value",result.jatuh_tempo);
          $("#wajibPajakId").attr("value",result.id);
        },"json");

        if(($("#updateId").length > 0)){
          console.log('ada id');
          $.post("{{url('operator/ketetapanPajak/getEditData')}}",{id:$("#updateId").val()},function(data){
            console.log(data);
            $('#itemKetetapanPajak').html(
              "<tr>\
              <td>1</td>\
              <td><input type=text class=form-control name=namaItem value="+data.nama_item+"></td>\
              <td><input type=text class=form-control name=volume value="+data.volume+"></td>\
              <td><input type=text class=form-control name=satuan value="+data.satuan+"></td>\
              <td><input type=text class=form-control name=harga value="+data.harga+"></td>\
              </tr>"
            );
          },"json");
        } else {
          console.log('ga ada id');
          $("#addItem").html(
            "<button type=button class='btn btn-info btn-block' name=button>Add Item</button>"
          );
          $("#removeItem").html(
            "<button type=button class='btn btn-danger btn-block' name=button>Remove Item</button>"
          );
          $('#itemKetetapanPajak').html(
            "<tr>\
            <td>1</td>\
            <td><input type=text class=form-control name=namaItem1></td>\
            <td><input type=text class=form-control name=volume1></td>\
            <td><input type=text class=form-control name=satuan1></td>\
            <td><input type=text class=form-control name=harga1></td>\
            </tr>"
          );
        }

      });

      $("#addItem").click(function(){
        i=i+1;
        $('#itemKetetapanPajak').append(
          "<tr id=item"+i+">\
          <td>"+i+"</td>\
          <td><input type=text class=form-control name=namaItem"+i+"></td>\
          <td><input type=text class=form-control name=volume"+i+"></td>\
          <td><input type=text class=form-control name=satuan"+i+"></td>\
          <td><input type=text class=form-control name=harga"+i+"></td>\
          </tr>"
        );
        $("#totalItem").html(
          "<input type=hidden name=totalItem value="+i+">"
        );

      });

      $("#removeItem").click(function(){
        $("#item"+i).remove();
        i=i-1;
      });

    });
  </script>
@endsection
