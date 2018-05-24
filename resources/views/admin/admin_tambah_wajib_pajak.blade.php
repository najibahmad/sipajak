@extends('layouts/horizontal_admin')
@section('title','Control Panel')
@section('dashboard-active',"class=active")
@section('content')
  <div class="container">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Wajib Pajak
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> <a href="{{url('/')}}">Beranda</a>
                </li>
            </ol>
        </div>
    </div>

    <a href="{{URL('admin/wajibPajak')}}"><button type="button" class="btn btn-default" name="button">Back</button></a>
    <hr>
    <!-- /.row -->
    <form class="form-horizontal" action="{{URL('admin/wajibPajak/insertWajibPajak')}}" role="form" method="post">
      <div class="form-group">
        <label class="control-label col-sm-2" for="namaJenisPajak">Nama Jenis Pajak</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="nama" placeholder="Nama" @if (isset($edit))
            value="{{$edit->nama}}"
          @endif>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="NPWP">NPWD:</label>

        <div class="col-sm-10">
          <input type="text" id="NPWP" class="NPWP form-control" name="NPWP" placeholder="NPWP" @if (isset($edit))
            value="{{$edit->npwp}}"
          @endif>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="kecamatan">Kecamatan</label>
        <div class="col-sm-10">
          <select class="form-control" id="kecamatan" name="kecamatan">
            <option>Silahkan pilih Kecamatan</option>

            @if (isset($edit))
            @foreach ($kecamatan as $no => $ini)
              @if($ini->id == $kecamatan_id)
                <option value="{{$ini->id}}" selected>{{$ini->kecamatan}}</option>
              @else
                <option value="{{$ini->id}}">{{$ini->kecamatan}}</option>
              @endif
            @endforeach
            @else
            @foreach ($kecamatan as $no => $ini)
                <option value="{{$ini->id}}">{{$ini->kecamatan}}</option>
            @endforeach
            @endif
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="desa">Desa/Kelurahan:</label>
        <div class="col-sm-10">
          <select class="form-control" id="desa" name="desa">
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="alamat">Alamat:</label>
        <div class="col-sm-10">
          <textarea type="text" class="form-control" name="alamat" placeholder="Alamat">@if (isset($edit)){{$edit->alamat}}@endif
          </textarea>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="kecamatan">Jatuh Tempo:</label>
        <div class="col-sm-10">
          <input type="text" data-date-format='yyyy-mm-dd' class="datepicker form-control" data-provide="datepicker" name="jatuhTempo" placeholder="jatuh tempo" @if (isset($edit))
            value="{{$edit->jatuh_tempo}}"
          @endif>
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

  </div>

@endsection

@section('script')
  <script type="text/javascript">

    $(document).ready(function(){
      jQuery(function($){
       $("#NPWP").mask("99.999.999.9-999.999");
      });

      $('#kecamatan').change(function(){
        var kecamatan=$('#kecamatan').val();
        $.post("{{url('admin/wajibPajak/getDesa')}}",{id:kecamatan},function(data){
          console.log(data);
          $('#desa').html("");
          $.each(data,function(i,item){
            $('#desa').append(
              "<option value="+this.id+">"+this.desa+"</option>"
            );
          });
        },"json");
      });

      @if (isset($id))
        //alert('{{$edit->desa_id}}');
        //select kecamatan

        var desa_id = {{$edit->desa_id}};
        var kecamatan={{$kecamatan_id}};
        $.post("{{url('admin/wajibPajak/getDesa')}}",{id:kecamatan},function(data){
          console.log(data);
          $('#desa').html("");
          $.each(data,function(i,item){
            if(this.id==desa_id){
              $('#desa').append(
                "<option value="+this.id+" selected>"+this.desa+"</option>"
              );
            }
            else{
              $('#desa').append(
                "<option value="+this.id+">"+this.desa+"</option>"
              );
            }

          });
        },"json");
      @endif

    });

  </script>

@endsection
