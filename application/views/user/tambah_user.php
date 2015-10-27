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
                        	<div class="panel-heading">Input Data Admin</div>
                        		<div class="panel-body">
					<?php error_reporting(0);?>
					<?php echo $error; ?>
					<form class="form-horizontal" action="<?php echo site_url('user/save'); ?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="id_user">
						
						<div class="form-group">
							<label class="col-xs-3">Nama Pengguna</label>
							<div class="col-xs-6">
								<input type="text" name="nama_pengguna" required placeholder="Masukan Nama Pengguna" class="form-control">
								<?php echo form_error('nama_pengguna', '<div class="alert alert-danger contact-warning">', '</div>'); ?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-xs-3">Foto</label>
							<div class="col-xs-6">
								<input type="file" name="photo" multiple="" >
							</div>
						</div>

						<div class="form-group">
							<label class="col-xs-3">Username</label>
							<div class="col-xs-6">
								<input type="text" name="username" required placeholder="Masukan Username" class="form-control">
								<?php echo form_error('username', '<div class="alert alert-danger contact-warning">', '</div>'); ?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-xs-3">Password</label>
							<div class="col-xs-6">
								<input type="text"  name="password" required placeholder="Masukan Password" class="form-control">
								<?php echo form_error('password', '<div class="alert alert-danger contact-warning">', '</div>'); ?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-xs-3">Status</label>
							<div class="col-xs-6">
								<select name="status" class="form-control"  required>
									<option value="">--Pilih Hak Akses--</option>
									<option value="admin">Admin</option>
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
					</div>
			 	</div><!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
<?php get_footer();?>

						
					