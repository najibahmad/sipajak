@extends('layouts/horizontal_admin')
@section('title','Control Panel')
@section('tarif-active',"class=active")
@section('content')
  <div class="container">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Standar Tarif Pajak
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> <a href="{{url('admin/dashboard')}}">List Tarif Pajak</a>
                </li>
            </ol>
        </div>
    </div>
    <hr>
    <form class="" action="index.html" method="post">
      <div class="form-group col-md-3">
        <label for="sel1">Standar Tarif Pajak Tahun:</label>
        <select class="form-control" id="tahun">
          <option value="">Select Year</option>
          @for ($i = 0; $i < count($tahun); $i++)
            <option value="{{$tahun[$i]}}">{{$tahun[$i]}}</option>
          @endfor
          
        </select>
      </div>
    </form>


    <div class="row">
      <div class="col-lg-12">
        <form action="{{URL('admin/tarif/tambahTarifPajak')}}" method="post">
          <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Standar Tarif Pajak</button>
        </form><hr>
        <table class="table table-striped">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama Item</th>
                <th>Jenis</th>
                <th>Satuan</th>
                <th>Tarif</th>
                <th>Tahun</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="data">
              @foreach ($data as $no => $ini)
                <tr>
                  <td>{{$no+1}}</td>
                  <td>{{$ini->nama_item}}</td>
                  <td>{{$ini->jenis}}</td>
                  <td>{{$ini->satuan}}</td>
                  <td>{{$ini->tarif}}</td>
                  <td>{{$ini->tahun}}</td>
                  <td>
                    <button type="submit" name="button" class="btn btn-warning" onclick="event.preventDefault();document.getElementById('editTarifPajak.{{$ini->id}}').submit();">Edit</button>
                    <button type="submit" name="button" class="btn btn-danger" onclick="event.preventDefault();document.getElementById('hapusTarifPajak.{{$ini->id}}').submit();">Delete</button>
                    <form id="editTarifPajak.{{$ini->id}}" action="{{URL('admin/tarif/editTarifPajak')}}" method="post">
                        <input type="hidden" name="id" value="{{$ini->id}}">
                    </form>
                    <form id="hapusTarifPajak.{{$ini->id}}" action="{{URL('admin/tarif/hapusTarifPajak')}}" method="post">
                        <input type="hidden" name="id" value="{{$ini->id}}">
                    </form>
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
      $('#tahun').change(function(){
        var data = $('#tahun').val();
        console.log(data);
        $.post("{{url('admin/tarif/getStandarTarif')}}",{tahun:data},function(data){
          console.log(data);
          $('#data').html("");
          $.each(data,function(i,item){
            i=i+1;
            $('#data').append(
              "<tr>\
              <td>"+i+"</td>\
              <td>"+this.nama_item+"</td>\
              <td>"+this.jenis+"</td>\
              <td>"+this.satuan+"</td>\
              <td>"+this.tarif+"</td>\
              <td>"+this.tahun+"</td>\
              <td>\
              <button type=submit class='btn btn-warning' onclick=event.preventDefault();document.getElementById('editTarifPajak').submit();>Edit</button>\
              <button type=submit class='btn btn-danger' onclick=event.preventDefault();document.getElementById('hapusTarifPajak').submit();>Delete</button>\
              <form id=editTarifPajak action={{URL('admin/tarif/editTarifPajak')}} method=post>\
                <input type=hidden name=id value="+this.id+">\
              </form>\
              <form id=hapusTarifPajak action={{URL('admin/tarif/hapusTarifPajak')}} method=post>\
                <input type=hidden name=id value="+this.id+">\
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
