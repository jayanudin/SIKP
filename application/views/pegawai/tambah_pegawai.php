<?php get_header();?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/datepicker/css/datepicker.css">
        <script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                
                $('#datepicker').datepicker({
                   format: "yyyy-mm-dd"
                });  
            
            });
        </script>
<?php get_sidebar();?>
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
                        	<div class="panel-heading">Input Data Pegawai</div>
                        		<div class="panel-body">
					<?php error_reporting(0);?>
					<?php echo $error; ?>
					<form class="form-horizontal" action="<?php echo site_url('pegawai/save'); ?>" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label class="col-xs-3">NIP</label>	
							<div class="col-xs-6">
								<input type="text" name="nip" id="nip"  required placeholder="Masukan NIP" class="form-control">
								<?php echo form_error('nip', '<div class="alert alert-danger contact-warning">', '</div>'); ?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-xs-3">Nama Pegawai</label>	
							<div class="col-xs-6">
								<input type="text" name="nama_pegawai" required placeholder="Masukan Nama Pegawai" class="form-control">
								<?php echo form_error('nama_pegawai', '<div class="alert alert-danger contact-warning">', '</div>'); ?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-xs-3">Jenis Kelamin</label>	
							<div class="col-xs-6">
								<select name="jenis_kelamin" class="form-control"  required placeholder="Pilih Jenis Kelamin">
									<option value="">--Pilih Jenis Kelamin--</option>
									<option value="Laki-laki">Laki-Laki</option>
									<option Value="Perempuan">Perempuan</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-xs-3">Foto</label>
							<div class="col-xs-6">
								<input type="file" name="photo" multiple="" >
							</div>	
						</div>

						<div class="form-group">
							<label class="col-xs-3">Golongan</label>
							<div class="col-xs-6">
								<input type="text" name="golongan" id="golongan" required placeholder="Masukan Golongan" class="form-control">
								<?php echo form_error('golongan', '<div class="alert alert-danger contact-warning">', '</div>'); ?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-xs-3">Jabatan</label>
							<div class="col-xs-6">
								<select name="jabatan_id_jabatan" class="form-control"  required placeholder="Pilih Jabatan">
									<option value="">--Pilih Jabatan--</option>
									<?php
										if (count($jabatan)) {
											foreach ($jabatan as $key => $list) {
												echo "<option value='". $list['id_jabatan'] . "'>" . $list['jabatan'] . "</option>";
											}		
										}
									?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-xs-3">Alamat</label>
							<div class="col-xs-6">
								<textarea cols="20" name="alamat_pegawai" class="form-control" style="overflow:scroll; height:200px;"></textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="col-xs-3">No Telepon</label>
							<div class="col-xs-6">
								<input type="text" name="no_telepon" id="telepon" required placeholder="Masukan No Telepon" class="form-control">
								<?php echo form_error('no_telepon', '<div class="alert alert-danger contact-warning">', '</div>'); ?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-xs-3">Tempat Lahir</label>
							<div class="col-xs-6">
								<input type="text" name="tempat_lahir" required placeholder="Masukan Tempat Lahir" class="form-control">
								<?php echo form_error('tempat_lahir', '<div class="alert alert-danger contact-warning">', '</div>'); ?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-xs-3">Tanggal Lahir</label>
							<div class="col-xs-6">
								<input type="text" name="tanggal_lahir" required placeholder="Masukan Tanggal Lahir" id="datepicker" class="form-control" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-xs-3">Password</label>
							<div class="col-xs-6">
								<input type="text" name="password" required placeholder="Masukan Password" class="form-control">
								<?php echo form_error('password', '<div class="alert alert-danger contact-warning">', '</div>'); ?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-xs-3">Status</label>
							<div class="col-xs-6">
								<select name="status" class="form-control">
									<option value="">--Pilih Status--</option>
									<option value="Pengajar">Pengajar</option>
									<option value="Non Pengajar">Non Pengajar</option>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-xs-3">Status Pekerjaan</label>
							<div class="col-xs-6">
								<select name="status_kerja" class="form-control">
									<option value="">--Pilih Status Pekerjaan--</option>
									<option value="PNS">PNS</option>
									<option value="Non PNS">Non PNS</option>
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
   								<?php echo form_close();?>
                        		</div>
					</div>
			</div><!-- /.row (main row) -->
         </section><!-- /.content -->
       </aside><!-- /.right-side -->
				
	
<?php get_footer();?>

						
					