<html>
<head>
	<title></title>
</head>
<body>

<style type="text/css">
 .tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
 	img{
 		width: 70px;
 		height: 70px;
 	}
 	h2{
 		text-align: center;
 		font-family: arial;
 		font-size: 14px;
 		line-height: 5px;
 	}
 	p{
 		font-size: 10px;
 		line-height: 0;
 	}
 	h3{
 		font-family: arial;
 	}

 	.data{
 		border: solid 0.1px black;
 	}
 	#header{
 		width: 100%;
 		height: 80px;
 		border-bottom: 1px solid black;
 		margin-bottom: 20px;
 	}
 	#header h3{
 		text-align: center;
 	}
 	#content{
 		width: 100%;
 	}
 	#content h2{
 		text-align: center;
 	}
 	#content p{
 		text-align: left;
 		padding-left: 5px;
 	}
 	#footer{
 		width: 100%;
 	}
 	#footer p{
 		font-style: italic;
 		font-size: 12px;
 		text-align: left;
 	}
 	#header-left{
 		float: left;
 		width: auto;
 		height: auto;
 	}
 	#header-right{
 		float: left;
 		width: auto;
 		height: auto;
 		padding-left: 20px;
 	}
 	#header-right h2, h3, p{
 		text-align: center;
 	}
 	#tab-ttd{
 		width: 100%;
 		height: 200px;
 		padding-top: 50px;
 	}
 	#tab-ttd p, h3{
 		text-align: left;
 	}
 	.left-ttd{
 		float: left;
 		width: 300px;
 		height: 200px;
 		text-align: left;
 	}
 	.left-ttd p{
 		font-size: 14px;
 		padding-bottom: 20px;
 	}
 	.right-ttd{
 		padding-left: 50px;
 		float: right;
 		width: 300px;
 		height: 200px;
 		text-align: left;
 	}
 	.right-ttd p{
 		font-size: 14px;
 		padding-bottom: 20px;
 	}
 	.kepsek-ttd{
 		width: 300px;
 		height: 100px;
 	}
 	.kepsek-nama{
 		width: 300px;
 		height: 60px;
 	}
 	.nip-tags{
 		width: 300px;
 		height: 40px;
 	}
 	.nip-tags p{
 		padding: 0;
 	}
 	.nip-tags-right{
 		width: 300px;
 		height: 20px;
 	}
 	.nip-tags-right p{
 		padding: 0;
 	}
 	#catatan{
 		width: 400px;
 		height: 200px;
 		border: 1px solid black;
 	}
 	#catatan-tags{
 		width: 400px;
 		height: 30px;
 	}
 	#catatan-tags p{
 		font-size: 14px;
 		text-align: left;
 	}
 </style>
 <div id="header">
 	<div id="header-left">
 		<img src="<?php echo base_url();?>assets/img/logo.gif" >
 	</div>
 	<div id="header-right">
 		<h2>PEMERINTAH KABUPATEN BANDUNG BARAT</h2>
 		<h2>DINAS PENDIDIKAN PEMUDA DAN OLAHRAGA</h2>
 		<h2>SMP NEGERI 2 PADALARANG</h2>
 		<p>Jl.Letkol GA Manulang-Purabaya, (022) 680961, Kec.Padalarang-Kab.Bandung Barat</p>
 	</div>
 </div>
	<div id="content">
	</table>
		<table>		
			<h2>LAPORAN KEHADIRAN PEGAWAI PER PEGAWAI</h2>						
		</table>

					<br>
					<table >

						<?php
								foreach($limit as $db){

						?>
							<tr>
								<td>NIP </td><td>:</td><td><td><?php echo $db->pegawai_nip; ?></td></td>

							</tr>
							<tr>
								<td>NAMA PEGAWAI </td><td>:</td><td><td><?php echo $db->nama_pegawai;?></td></td>
								
							</tr>
							<tr>
								<td>TAHUN AKADEMIK </td><td>:</td><td><td><?php echo $db->tahun_akademik; ?></td></td>
								
							</tr>
						<?php
						
							}
					

					?>
					</table>

					<br>
					<br>

		<table width="100%" class='tg'>
						<tr>
							<th class='tg-031e'>NO</th>
							<th class='tg-031e'>HARI / TANGGAL</th>
							<th class='tg-031e'>WAKTU MASUK</th>
							<th class='tg-031e'>WAKTU KELUAR</th>
							<th class='tg-031e'>KETERANGAN</th>

						</tr>
						<?php
							if (empty($query)) {
								echo "<p>Data Tidak Tersedia</p>";
							}else{
								$no = 1;
								foreach($query as $db)
								{
						?>
							<tr>
								<td class='tg-031e' align='center'><?php echo $no; ?></td>
								<td class='tg-031e'><?php echo $db->hari; ?>, <?php echo $db->tanggal_masuk; ?></td>
								<td class='tg-031e'><?php echo $db->waktu_masuk; ?></td>
								<td class='tg-031e'><?php echo $db->waktu_keluar; ?></td>
								<td class='tg-031e' align="center"><?php echo $db->keterangan; ?></td>
							</tr>
							<?php
							$no++;
							}
					}
					?>		
		</table>

		<table>
			
					<?php
							if (empty($jumlah_hadir)) {
								echo "<p>Data Tidak Tersedia</p>";
							}else{

								foreach($jumlah_hadir as $db)
								{
						?>
							<tr>
								<td>Jumlah Hadir : <?php echo $db->keterangan; ?></td>
							</tr>

							<?php

							}
					}
					?>
					<?php
							if (empty($jumlah_telat)) {
								echo "<p>Data Tidak Tersedia</p>";
							}else{

								foreach($jumlah_telat as $db)
								{
						?>
							<tr>
								<td>Jumlah Telat : <?php echo $db->keterangan; ?></td>
							</tr>

							<?php

							}
					}
					?>
	
		</table>
	</div>

	<div id="catatan-tags">
		<p>Catatan</p>
	</div>
	<div id="catatan"></div>


	<div id="footer">
		<p>Cetak : <?php echo date('d-M-y')?></p>
	</div>

