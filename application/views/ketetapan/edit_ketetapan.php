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
                        	<div class="panel-heading">Edit Ketetapan Jam Mengajar</div>
                        		<div class="panel-body">

					<?php error_reporting(0);?>
					<?php echo $error; ?>
					<form class="form-horizontal" action="<?php echo site_url('ketetapan_jam/update'); ?>" method="post">
						<input type="hidden" name="idketetapan_jam" value="<?php echo $idketetapan_jam; ?>">
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
								<input type="text" id="jam" value="<?php echo $jumlah_jam; ?>" id ="datepicker" name="jumlah_jam" required placeholder="Masukan Jumlah Jam" class="form-control">
								<?php echo form_error('jumlah_jam', '<div class="alert alert-danger contact-warning">', '</div>'); ?>
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
                        	<div class="panel-heading">Edit</div>
                        		<div class="panel-body">
                        			<table>
                        				<tr>
											<td>&nbsp;</td><td>&nbsp;</td><td><input type="submit" class="btn btn-success" value="Update" name="update"> <input type="reset" class="btn btn-danger" value="Batal"></td>
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

						
					