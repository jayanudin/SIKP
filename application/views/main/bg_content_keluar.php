<div class="container">
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<div id="header">
							<div class="offButton">
								<a href="<?php echo base_url();?>auth/logout" title="Logout"><i class="fa fa-power-off"></i></a>
							</div>
								<h2>SISTEM INFORMASI KEHADIRAN KERJA PEGAWAI SMPN 2 PADALARANG</h2>
								<p>Jl. Letkol G. a. Manulang Padalarang, Bandung Barat</p>
						</div>
					<div id="content">
						
						<h3>Waktu Keluar</h3>
						<body onLoad="renderDate()">
						<div id="jam" align="center">
						</div>
						<table>
							<form action="<?php echo site_url('main/save_keluar'); ?>" method="post">
								<tr>
									<td>
										<select name="pegawai_nip" data-placeholder="Pilih Nama Pegawai" class="chosen-select form-control" single style="width:350px;" tabindex="4">
										<option value="">--Pilih Nama Anda--</option>
										<?php
											if (count($nip)) {
												foreach ($nip as $key => $list) {
													echo "<option value='". $list['nip'] . "'>" . $list['nama_pegawai'] . "</option>";
												}		
										}
											?>
										</select>
									</td>
								</tr>

								<tr>
									<td>
										<div class="input-group">
										  <span class="input-group-addon"><i class="fa fa-keyboard-o"></i></span>
										  <input type="password" name="password" class="form-control" placeholder="Masukan Password">
										  <input type="hidden" name="tanggal_masuk" value="<?php echo $waktu_masuk;?>">
										</div>
									</td>
								</tr>
								<tr>
							<td>
							<select name="akademik_idakademik" class="form-control" readonly="readonly">
								<?php
									if (count($akademik)) {
										foreach ($akademik as $key => $list) {
											echo "<option value='". $list['idakademik'] . "'>" . $list['tahun_akademik'] . "</option>";
										}		
									}
								?>
							</select>
								</td>
							</tr>
							<tr>
									<td>
										  <input type="hidden" name="hari" value="<?php echo $hari;?>">
									</td>
								</tr>
								<tr>
									<td>
										<input type="submit" class="btn1 btn-2 btn-2a" value="Submit" name="submit">
									</td>
								</tr>
							</form>
						</table>
						<br>
						<?php echo validation_errors(); ?>
						<?php echo form_close();?>
					</div>
				</div>
				<div class="col-md-3"></div>
				</div>
			</div>
		</div>