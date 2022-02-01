<?php
	require_once(".../setty/config.php");	
?>
<div class="panel panel-primary">
	<div class="panel-heading">Sales Area</div>
	<div class="panel-body">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#syarat" data-toggle="tab">Persyaratan Umum</a></li>
			<li><a href="#jobdesk" data-toggle="tab">Job Desk</a></li>
			<li><a href="#benef" data-toggle="tab">Benefits</a></li>
			<li><a href="#daftar" data-toggle="tab">Daftar Sekarang</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane fade in active" id="syarat">
				<p><h4 class="jdl-jobdesk"><i class="fa fa-newspaper-o"></i>&nbsp;&nbsp;Persyaratan Umum</h4>
				<ol class="ls-jobdesk">
					<li>Pendidikan min. SMK.</li>
					<li>Dapat menggunakan program Microsoft Office (PowerPoint, Excel, Word & Outlook).</li>
					<li>Memiliki kepribadian menyenangkan, senang bersosialisasi, berpikir kritis, percaya diri, dewasa & memiliki jiwa melayani.</li>
					<li>Mahir dalam penggunaan media/jejaring sosial</li>
					<li>Nyaman bertemu dengan orang baru untuk menjalin kerjasama dan memimpin Project Management.</li>
					<li>Senang untuk membangun merek dan sadar dengan kekuatan Public Relations.</li>
				</ol></p>
			</div>
			<div class="tab-pane fade" id="jobdesk">
				<p><h4 class="jdl-jobdesk"><i class="fa fa-bullhorn"></i>&nbsp;&nbsp;Job Desk</h4>
				<ol class="ls-jobdesk">
					<li>Mencari Customer Baru</li>
					<li>Melakukan proses penjualan</li>
					<li>Menjalin komunikasi yang baik dengan Customer</li>
					<li>Membuat laporan penjualan harian, Mingguan, Bulanan</li>
					<li>Membangun hubungan antar divisi – divisi lain</li>
					<li>Visit / Kunjungan potensial customer</li>
					<li>Membujuk customer untuk membeli produk</li>
					<li>Membuat penawaran</li>
					<li>Negosiasi Harga</li>
					<li>Penagihan invoice jatuh tempo</li>				
				</ol></p>
				<p><h4 class="jdl-jobdesk"><i class="fa fa-bullhorn"></i>&nbsp;&nbsp;Langkah-langkah Kerja</h4>
				<ol class="ls-jobdesk">
					<li>Minta data Customer berupa: Nama, Alamat, No.Telp, Kontak WA, Alamat Email. Untuk dealer yg sudah ada.</li>
					<li>Infokan Stok Barang dengan status: Ready / Inden / Discontinue.</li>
					<li>Buat penawaran estimasi sesuai permintaan customer.</li>
					<li>Meminta ke bagian teknisi untuk survey tempat (siapkan form survey).</li>
					<li>Terima Form Survey dari teknisi yang telah mensurvey.</li>
					<li>Cek dan revisi penawaran disesuaikan dengan hasil survey.</li>
					<li>Kirim penawaran Fix Via Email / WA.</li>
					<li>Follow up customer akan penawaran yang telah diterimanya.</li>
					<li>Setelah Fix dan customer minta untuk pemasangan, cetak penawaran ulang dan serahkan kebagian admin teknisi dan minta DP 50% dari penawaran serta buatkan kwitansi DP nya.</li>
					<li>Minta jadwal untuk pemasangan ke admin teknisi lalu hubungi customer.</li>
					<li>Setelah selesai pengerjaan, proses invoice bersama admin dan dibantu bagian finance utk penagihan sisa invoice.</li>
					<li>Untuk Dealer, input di program inventory.</li>
					<li>Cetak surat jalan dan serahkan ke admin gudang untuk menyiapkan barang.</li>
					<li>Terima surat jalan dari admin gudang yang telah berisi SN (Serial Number).</li>
					<li>Input di program Uinventory revisi nota setelah dari admin gudang lalu cetak nota.</li>
					<li>Serahkan barang + Surat Jalan + Nota dan minta TTD Customer.</li>
					<li>Bantu Penagihan.</li>
					<li>Update Rekapan Penjualan.</li>
					<li>Update Laporan Penjualan</li>
				</ol></p>
			</div>
			<div class="tab-pane fade" id="benef">
				<p><h4 class="jdl-jobdesk"><i class="fa fa-money"></i>&nbsp;&nbsp;Benefits</h4>
				<ol class="ls-jobdesk">
					<li>Berdasarkan kinerja pribadi.</li>
					<li>Termasuk tunjangan kesehatan dan tunjangan tepat waktu (On Time Attendance Allowance).</li>
					<li>Berdasarkan kinerja perusahaan & pribadi.</li>
					<li>Status kepegawaian tetap & full time.</li>
					<li>Asuransi Kesehatan (BPJS).</li>
					<li>Cuti dalam setahun 12 hari (1 bln / 1 hari).</li>
				</ol></p>
			</div>
			<div class="tab-pane fade" id="daftar">
				<p><h4 class="jdl-jobdesk"><i class="fa fa-edit"></i>&nbsp;&nbsp;Form Pendaftaran</h4>
					<div class="alert alert-info text-center status" style="font-size:2em; display:none;"></div>
					<form role="form" id="frm-block">
						<div class="form-group">
							<label>Nama Lengkap</label>
							<input type="text" id="nm_cus" name="nm_cus" class="form-control" placeholder="Nama Lengkap Anda" />
						</div>
						<div class="form-group">
							<label>No. HP</label>
							<input type="text" id="kontak_cus" name="kontak_cus" class="form-control" placeholder="cth: 08xxxxxxxxxx" />
						</div>
						<div class="form-group">
							<label>Alamat E-Mail</label>
							<input type="text" id="email_cus" name="email_cus" class="form-control" placeholder="cth: admin@gmail.com" />
						</div>
						<input type="hidden" id="job" name="job" value="sales"/>
						<div class="form-group">
							<button type="submit" class="btn btn-success tdaftar">Daftar</button>
						</div>
					</form><hr />
					<div class="alert alert-danger">Bagi anda yang sudah melakukan pendaftaran. Segera kirimkan berkas lamaran anda ke alamat email ( admin@globalintertech.co.id )</div>
				</p>
			</div>
		</div>
	</div>
	<div class="panel-footer"><button class="btn btn-danger btn-kembali"><i class="fa fa-mail-reply"></i>&nbsp;&nbsp;Kembali</button></div>
</div>
<script type="text/javascript">
$(function () { formValidation(); });
$("#frm-block").submit(function(e){
	var nama = $("#nm_cus").val(), kontak = $("#kontak_cus").val(), email = $("#email_cus").val(), job = $("#job").val();
	var sData = "&nama="+nama+"&kontak="+kontak+"&email="+email+"&job="+job;
	if(nama != "" && kontak != "" && email != "" && kontak.length > 11 && kontak.length < 13 && kontak.which!=8 && kontak.which!=0){
		e.preventDefault();
		$.ajax({
			beforeSend: function(){
				$(".tdaftar").html("Mohon Tunggu....");
			},
			type: 'GET',
			url: 'karirax/proses',
			data: 'op=sv_daftar_palamar'+sData,
			cache: false,
			success: function(msg){
				if(msg == "oke"){
					$(".tdaftar").html("Daftar");
					$("#frm-block").fadeOut("slow");
					$(".status").fadeIn("slow");
					$(".status").html("Terimakasih, Anda sudah terdaftar sebagai pelamar pada Job Desk ini.");
				} else if(msg == "ada"){
					$(".tdaftar").html("Daftar");
					$("#frm-block").fadeOut("slow");
					$(".status").fadeIn("slow");
					$(".status").html("Anda sudah terdaftar sekarang.");
				} else {
					$(".tdaftar").html("Daftar");
					alert(msg);
				}
			}			
		});	
		return false;
	}
});
var _0xcbaf=["\x73\x6C\x6F\x77","\x66\x61\x64\x65\x49\x6E","\x2E\x6C\x6F\x61\x64\x65\x72","\x2E\x6C\x69\x73\x74\x2D\x6B\x61\x72\x69\x72","\x66\x61\x64\x65\x4F\x75\x74","","\x68\x74\x6D\x6C","\x2E\x64\x65\x74\x61\x69\x6C\x2D\x6B\x61\x72\x69\x72","\x61\x6A\x61\x78","\x63\x6C\x69\x63\x6B","\x2E\x62\x74\x6E\x2D\x6B\x65\x6D\x62\x61\x6C\x69","\x72\x65\x61\x64\x79"];$(document)[_0xcbaf[11]](function(){$(_0xcbaf[10])[_0xcbaf[9]](function(){$[_0xcbaf[8]]({beforeSend:function(){$(_0xcbaf[2])[_0xcbaf[1]](_0xcbaf[0])},success:function(){$(_0xcbaf[3])[_0xcbaf[1]](_0xcbaf[0]);$(_0xcbaf[2])[_0xcbaf[4]](_0xcbaf[0]);$(_0xcbaf[7])[_0xcbaf[6]](_0xcbaf[5])}})})})
</script>