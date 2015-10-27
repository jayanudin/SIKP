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
						<?php
							if (empty($tahun_akademik)) {
								echo "<p>Data Tidak Tersedia</p>";
							}else{
							
								foreach($tahun_akademik as $db)
								{
						?>
								<h2>REKAPITULASI DAFTAR KEHADIRAN PEGAWAI</h2>
								<!-- <h2>Tahun Akademik <?php echo $db->tahun_akademik;?></h2> -->
							
							<?php
						
							}
					}
					?>
							
					</table>

					<br>
					<br>

		<table width="100%" class='tg'>
						<tr>
							<th class='tg-031e'>NO</th>
							<th class='tg-031e'>NAMA / NIP DAN GOL</th>
							<th class='tg-031e'>HARI /TANGGAL</th>
							<th class='tg-031e'>STATUS PEGAWAI</th>
							<th class='tg-031e'>KETERANGAN</th>
							<th class='tg-031e'>CEK</th>

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
								<td class='tg-031e'>
									<?php echo $db->nama_pegawai; ?> /
									<?php echo $db->pegawai_nip; ?> /
									<?php echo $db->golongan; ?>
								</td>
								<td class='tg-031e'><?php echo $db->hari; ?>, <?php echo $db->tanggal_masuk; ?></td>
								<td class='tg-031e'><?php echo $db->status; ?></td>
								<td class='tg-031e' align="center"><?php echo $db->keterangan; ?></td>
								<td class='tg-031e' align="center">&nbsp; &nbsp;</td>
							</tr>
							<?php
							$no++;
							}
					}
					?>
							
		</table>
		<table>
			<?php
							if (empty($jumlah_hadir_day)) {
								echo "<p>Data Tidak Tersedia</p>";
							}else{

								foreach($jumlah_hadir_day as $db)
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
							if (empty($jumlah_telat_day)) {
								echo "<p>Data Tidak Tersedia</p>";
							}else{

								foreach($jumlah_telat_day as $db)
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
		<div id="tab-ttd">
			<div class="left-ttd">
				<p>Mengetahui</p>
				<p>Kepala Sekolah</p>
				<div class="kepsek-ttd"></div>
				<div class="kepsek-nama">
					<h3>Drs. H Saprudin M.Pd</h3>
				</div>
				<div class="nip-tags">
					<p>Pembina TK.I.IV/b</p>
					<p>NIP. 19621215</p>
				</div>
			</div>
			<div class="right-ttd">
				<p>Padalarang, <?php echo date('M-Y')?></p>
				<p>Sie Absensi</p>
				<div class="kepsek-ttd"></div>
				<div class="kepsek-nama">
					<h3>Hotma Parulian, S.Pd, SE</h3>
				</div>
				<div class="nip-tags-right">
					<p>NUPTK : 1740756656200012</p>
				</div>
			</div>
		</div>


	
	</div>

	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<div id="footer">
		<p>Cetak : <?php echo date('Y-m-d');?></p>
	</div>
