@extends('layouts/dashboard_admin')
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
      <div class="form-group">
        <label for="sel1">Standar Tarif Pajak Tahun:</label>
        <select class="form-control" id="tahun">
          <option value="">Select Year</option>
          <option value="2017">2017</option>
          <option value="2016">2016</option>
          <option value="2015">2015</option>
          <option value="2014">2014</option>
        </select>
      </div>
    </form>
    

    <div class="row">
      <div class="col-lg-12">
        <form action="{{URL('admin/tarif/tambahTarifPajak')}}" method="post">
          <button type="submit" class="btn btn-default">Tambah Standar Tarif Pajak</button>
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
                    <form action="{{URL('admin/tarif/editTarifPajak')}}" method="post">
                        <input type="hidden" name="id" value="{{$ini->id}}">
                        <button type="submit" name="button" class="btn btn-warning">Edit</button>
                    </form>
                    <form action="{{URL('admin/tarif/hapusTarifPajak')}}" method="post">
                        <input type="hidden" name="id" value="{{$ini->id}}">
                        <button type="submit" name="button" class="btn btn-danger">Delete</button>
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
              <form action={{URL('admin/tarif/editTarifPajak')}} method=post>\
                <input type=hidden name=id value="+this.id+">\
              <button type=submit class='btn btn-warning'>Edit</button>\
              </form>\
              <form action={{URL('admin/tarif/hapusTarifPajak')}} method=post>\
                <input type=hidden name=id value="+this.id+">\
              <button type=submit class='btn btn-danger'>Delete</button>\
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
