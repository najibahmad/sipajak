<html>
<head>
    <title>Laporan Sebaran Pondok Pesantren</title>
</head>
<style type="text/css">
hr {
  border: 1;
  border-top: 5px double;
}

table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 0px solid ;
    text-align: left;

}

tr:nth-child(even) {

}

@media print {
	img{
	    width: 95px;
	    height: 65px;
	}
	.tanda_tangan{
	float:left;
	padding-right: 100px;
	text-align:center;
	width:50%;
	}
	.tombol{
		display: none;
	}
}
.tombol{
	text-align: center;
	margin-bottom: 10px;
}

.print{
	float: right;
  display: inline-block;
  margin-bottom: 0;
  font-weight: 400;
  text-align: center;
  vertical-align: middle;
  cursor: pointer;
  background-image: url(print.png);
    background-repeat: no-repeat;
  background-position: 5px;
  border: 1px solid transparent;
  white-space: nowrap;
  padding: 6px 12px 6px 28px;
  font-size: 13px;
  line-height: 1.42857143;
  border-radius: 0;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  font-family: 'TitilliumText22LBold', Tahoma,Arial, sans-serif;
}
.kepala{
	margin-left: 30px;
	font-size: 17px;
}
.btn{
  color: #777777;
  background-color: #E1E4E3;
  border-color: #DAD9D9;
}
.btn:hover{
  color: #777777;
  background-color: #BABDBC;
  border-color: #B0B0B0;
}

#surat_tampil{
	width:480px;
	border:1px solid #4D4D4D;
	overflow:auto;
	padding:3px;
	margin:0 auto;
}
#kepala_surat{

	margin-left: 10px;
	margin:0 auto;
	text-align:center;

}
#header_surat{

	margin-left: 10px;
	margin:0 auto;
	text-align:left;
  float:left;
}
#header_surat2{

	margin-left: 10px;
	margin:0 auto;
	text-align:right;
  float:right;
}
img{
	  position: absolute;
    margin-left: 10px;
    margin-top: 3px;
    width: 80px;

}
.garis{
	border-bottom:2px solid #000;
	width:98%;
	margin-bottom:15px;
  margin-top: 10px;
  position: static;
  display: block;
}
.garis2{
	border-bottom:1px solid #000;
	width:98%;
	margin-bottom:105px;
  padding-top: 10px;
	display: block;
}
#content_surat{
	width:90%;
	position:auto;
	padding-left:30px;
	margin:0 auto;
	}

#content_surat label{
display:block;
width:140px;
float:left;
clear:both;
}
#content_surat span.s_kanan{
float:left;
max-width:200px;
text-align:justify;
}
#content_surat span.titik{
float:left;
width:10px;
}
#par_penutup,#par_pembuka,#nomer_surat{
	clear:both;
	position:relative;
	width:90%;
	margin:0 auto;
	margin-bottom:15px;
}
#nomer_surat{
	text-align:center;
}
.masuk_alinea{
	margin-right:20px;
}
.tanda_tangan{
	float:left;
	text-align:center;
	width:50%;
}
.kosong{
margin-bottom:50px;
}
</style>

<body>
<div class="ui-dialog-content ui-widget-content" style="width: auto; height: auto;">
<!-- awal kepala surat -->
 <!-- <img src="{{ asset('images/logo2.png') }}" > -->


 <div id="header_surat">


 <strong style="font-size:11px;">PEMERINTAH KABUPATEN KERINCI<br><br>
 </div>

 <div id="header_surat2">


 <strong style="font-size:11px;">Model Bend. 17<br>
   Lembar : I/II/III/IV/V
   <br>
 </div>

<div id="kepala_surat">
<div class="kepala" style="margin-top:30px;">

<strong>SURAT TANDA SETORAN<br></strong></div>
<!-- akhir kepala surat -->

  <div id="par_pembuka">

  <!--<span class="masuk_alinea">&nbsp;</span>


  Yang bertanda tangan dibawah ini,
  Lurah Kampung Melayu,
  Kecamatan Sukajadi, Kota Pekanbaru menerangkan dengan
  sebenarnya bahwa orang tersebut dibawah ini :
</div> -->

  <?php
  //$ambil=$this->m_rtrw->ambilrt($pend['idrw']);
  ?>
  <!--
  <div id="content_surat">
      <div id="bag_atas"><label>Nama</label><span class="titik">:</span><span class="s_kanan"> </span><br>
      <label>Hari</label><span class="titik">:</span><span class="s_kanan"> </span><br>
      <label>Tanggal</label><span class="titik">:</span><span class="s_kanan"> </span><br>
      <label>Di</label><span class="titik">:</span><span class="s_kanan"> </span><br><br></div>

      <div><div id="ket_tengah" style="font-weight:bolder">Telah lahir seorang anak:</div><br></div>

      <div id="bag_bawah"><label>Ibu</label><span class="titik">:</span><span class="s_kanan"> </span><br>
      <label>Ayah</label><span class="titik">:</span><span class="s_kanan"> </span><br>
      <label>Alamat</label><span class="titik">:</span><span class="s_kanan"> </span><br></div>
  </div>
-->

<table style="font-size:12px;padding:10px;" border="1" width="90%" align="center">
<tbody>
  <tr style="font-size:12px;padding:10px;">
    <td style="font-size:12px;padding:10px;">
      Setoran seperti yang ke .................. <br>
      dalam bulan .................................... <br>
      tahun .............................................. <br>
    </td>
    <td style="font-size:12px;padding:10px;">Nomor : ........................ <br></td>
    <td style="font-size:12px;padding:10px;">
      Setoran seperti ini yang terakhir telah dilakukan pada:<br>
      Tanggal : ........................ <br>
      Nomor &nbsp;  : ........................ <br>
    </td>
  </tr>
</tbody>
</table>

<table border="0" style="font-size:12px;padding:0px;margin-left:40px;" width="90%">
<tbody>
<tr>
<td style="width:200px;">Pemegang Kas Daerah Kab. Kerinci</td>
<td style="width:10px;">:</td>
<td>BPD Cabang Sungai Penuh</td>
</tr>
<tr>
<td colspan="3">Harap menerima uang sebesar Rp. {{number_format($jumlah,0)}}</td>

</tr>
<tr>
<td>(dengan huruf)</td>
<td>:</td>
<td><strong> <i>{{$terbilang}} </i> </strong></td>
</tr>
<tr>
<td>Dari</td>
<td>:</td>
<td>{{$ketetapanPajak->wajib_pajak->nama}}</td>
</tr>
<tr>
<td>Alamat </td>
<td>:</td>
<td>{{$ketetapanPajak->wajib_pajak->alamat}}</td>
</tr>
<tr>
<td>Sebagai Penyetoran</td>
<td>:</td>
<td>Pajak/Retribusi Daerah</td>
</tr>
</tbody>
</table>

<table style="font-size:12px;padding:10px;" border="1" width="90%" align="center">
<tbody>
<tr>
<td align="center">Kode Rekening / Ayat</td>
<td align="center">Jenis Penerimaan</td>
<td align="center">Jumlah</td>
</tr>
<?php
$i=5;
foreach ($ketetapanPajak->item_ketetapan_pajak as $row): ?>

    <tr>

      <td align="center">{{$ketetapanPajak->rekening_penerimaan->nomor_rekening}}</td>
      <td align="center">{{$row->nama_item}}</td>
      <td align="right">Rp. {{$row->harga}},-</td>
    </tr>
<?php
$i--;
endforeach; ?>
<?php
  for($k=0;$k<$i;$k++){
      ?>
      <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      </tr>
      <?php
  }
?>
</tbody>
</table>

<table style="font-size:12px;padding:10px;" border="1" width="90%" align="center">
<tbody>
  <tr style="font-size:12px;padding:10px;">
    <td style="font-size:12px;padding:10px;">
      <div class="kosong" id="pejabat">.........................................</div>
      <div id="nama_pejabat"><span style="text-transform:uppercase;text-decoration:underline;font-weight:bold"> ..................... </span></div>
      <div id="nama_pejabat"><span style="text-transform:uppercase;font-weight:bold"> </span></div>
    </td>
    <td style="font-size:12px;padding:10px;">
      <div class="kosong" id="pejabat">Sungai Penuh, tgl {{$tgl_pembayaran}}</div>
      <div id="nama_pejabat"><span style="text-transform:uppercase;text-decoration:underline;font-weight:bold"> ..................... </span></div>
      <div id="nama_pejabat"><span style="text-transform:uppercase;font-weight:bold"> </span></div>
    </td>
    <td style="font-size:12px;padding:10px;">
      <div class="kosong" id="pejabat">Uang tersebut diatas diterima:<br>Sungai Penuh, tgl {{$tgl_pembayaran}}</div>
      <div id="nama_pejabat"><span style="text-transform:uppercase;text-decoration:underline;font-weight:bold"> ..................... </span></div>
      <div id="nama_pejabat"><span style="text-transform:uppercase;font-weight:bold"> </span></div>
    </td>
  </tr>
</tbody>
</table>


  <!--<div id="par_penutup"><span class="masuk_alinea">&nbsp; </span>Demikian Surat Keterangan ini diberikan, untuk dapat digunakan atas dasar sebenarnya.</div>-->

  </div>
  </body>

  </html>
