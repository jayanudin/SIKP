<?php echo get_header();?>
<?php echo get_sidebar();?>
<aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <?php
							foreach ($breadcrumb as $key=>$value) {
								if($value!=''){
							?>
							    <li><a href="<?=$value; ?>"><?=$key; ?></a> <span class="divider"></span></li>
							    <?php }else{?>
							    <li class="active"><?=$key; ?></li>
							    <?php }
							}
							?>	
                    </ol>
                </section>

                <!-- Main content -->
           <section class="content">

                    <!-- Small boxes (Stat box) -->
              <div class="row">
					<div class="col-md-8">
						<div class="panel panel-success">
                        	<div class="panel-heading">Input Ketetapan Jam Mengajar</div>
                        		<div class="panel-body">
					<?php error_reporting(0);?>
					<?php echo $error; ?>
					<form class="form-horizontal" action="<?php echo site_url('ketetapan_jam/save'); ?>" method="post">
						<input type="hidden" name="idketetapan_jam">
						<div class="form-group">
							<label class="col-xs-3">Hari</label>
							<div class="col-xs-6">
								<select name="hari" required class="form-control">
									<option value="">--Pilih Hari--</option>
									<option value="Senin">Senin</option>
									<option value="Selasa">Selasa</option>
									<option value="Rabu">Rabu</option>
									<option value="Kamis">Kamis</option>
									<option value="Jumat">Jumat</option>
									<option value="Sabtu">Sabtu</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-xs-3">Jumlah Jam</label>
							<div class="col-xs-6">
								<input type="text" name="jumlah_jam" id="jam" required placeholder="Masukan Jumlah Jam" class="form-control">
								<?php echo form_error('jumlah_jam', '<div class="alert alert-danger contact-warning">', '</div>'); ?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-xs-3">Nama Pegawai</label>
							<div class="col-xs-6">
								<select name="pegawai_nip" class="form-control"  required >
									<option value="">--Pilih Pegawai--</option>
									<?php
										if (count($ketetapan_jam)) {
											foreach ($ketetapan_jam as $key => $list) {
												echo "<option value='". $list['nip'] . "'>" . $list['nama_pegawai'] . "</option>";
											}		
										}
									?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-xs-3">Tahun Akademik</label>
							<div class="col-xs-6">
								<select name="akademik_idakademik" class="form-control"  required >
									<option value="">--Pilih Tahun Akademik--</option>
									<?php
										if (count($tahun_akademik)) {
											foreach ($tahun_akademik as $key => $list) {
												echo "<option value='". $list['idakademik'] . "'>" . $list['tahun_akademik'] . "</option>";
											}		
										}
									?>
								</select>
							</div>
						</div>
					</div>
					</div>
					</div>
		
					<div class="col-md-4">
						<div class="panel panel-success">
                        	<div class="panel-heading">Publish</div>
                        		<div class="panel-body">
                        			<table>
                        				<tr>
											<td>&nbsp;</td><td>&nbsp;</td><td><input type="submit" class="btn btn-success" value="Simpan" name="submit"> <input type="reset" class="btn btn-danger" value="Batal"></td>
										</tr>
                        			</table>
                        		</div>
                        	</div>
                        </div>
                        <?php echo form_close();?>
				</div><!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
<?php get_footer();?>

						
					