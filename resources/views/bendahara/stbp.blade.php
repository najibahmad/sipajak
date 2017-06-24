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
    padding: 10px;
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
margin-bottom:100px;
}
</style>

<body>
<div class="ui-dialog-content ui-widget-content" style="width: auto; height: auto;">
<!-- awal kepala surat -->
 <!-- <img src="{{ asset('images/logo2.png') }}" > -->


<div id="kepala_surat">
<div class="kepala">

<strong>PEMERINTAH KABUPATEN KERINCI<br>
BADAN PENGELOLA PAJAK DAN RESTRIBUSI DAERAH<br>
(BPPRD)<br></strong></div>
Jl. Imam Bonjol No. 06 Sungai Penuh, e-mail:bpprd.krckab@yahoo.com<br><br>
<div class="kepala">

<strong>TANDA BUKTI PEMBAYARAN<br>
NOMOR BUKTI: .......................................<br></strong></div>

</div>
<!-- akhir kepala surat -->

<hr>
<div id="nomer_surat">
  <br>


  </div>
  <br>
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

<table >

    <tbody>
      <tr>
        <td width="10px" valign="top">a.)</td>
        <td colspan="2">
          Bendahara Penerima / Bendahara Penerimaan Pembantu ................<br>
          Telah menerima uang sebesar Rp. {{number_format($itemKetetapanPajak->harga,0)}}
        </td>
      </tr>
      <tr>
        <td valign="top">b.)</td>
        <td colspan="2"> Dengan huruf <strong> <i>{{$terbilang}} </i> </strong></td>
      </tr>

      <tr>
        <td valign="top">c.)</td>
        <td width="200px">Dari Nama</td>
        <td> {{$itemKetetapanPajak->ketetapan_pajak->wajib_pajak->nama}} </td>
      </tr>

      <tr>
        <td></td>
        <td>Alamat</td>
        <td>{{$itemKetetapanPajak->ketetapan_pajak->wajib_pajak->alamat}} </td>
      </tr>

      <tr>
        <td valign="top">d.)</td>
        <td valign="top">Sebagai Pembayaran</td>
        <td>{{$itemKetetapanPajak->nama_item}}</td>
      </tr>

      <tr>
        <td colspan="2">
        <table border="1" style="margin-left:50px;" width="600px">
          <tr>
            <td align="center">Kode Rekening / Ayat</tes>
              <td align="center">Jumlah (Rp)</tes>
          </tr>
          <tr>
            <td align="center">{{$itemKetetapanPajak->ketetapan_pajak->rekening_penerimaan->nomor_rekening}}</tes>
              <td align="center">Rp. {{number_format($itemKetetapanPajak->harga,0)}}</tes>
          </tr>
        </table>
      </td>
      </tr>

      <tr>
        <td>e.)</td>
        <td>Tanggal Diterima Uang</td>
        <td>{{$tgl_hari_ini}}</td>
      </tr>


    </tbody>
</table>

  <!--<div id="par_penutup"><span class="masuk_alinea">&nbsp; </span>Demikian Surat Keterangan ini diberikan, untuk dapat digunakan atas dasar sebenarnya.</div>-->


  <br>
  <div class="tanda_tangan" style="float:right">
      <div>Jakarta, .......................</div>
      <?php
        $tanda='Direktur Jenderal<br>Direktorat Pendidikan Diniyah<br>dan Pondok Pesantren';
      ?>
      <div class="kosong" id="pejabat"><?=$tanda?></div>
      <div id="nama_pejabat"><span style="text-transform:uppercase;text-decoration:underline;font-weight:bold"> </span></div>
      <div id="nama_pejabat"><span style="text-transform:uppercase;font-weight:bold"> </span></div>
  </div>
  </div>
  </body>

  </html>
