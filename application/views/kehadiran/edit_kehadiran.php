
<?php echo get_header();?>
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
                        	<div class="panel-heading">Edit Data Kehadiran</div>
                        		<div class="panel-body">
					<?php error_reporting(0);?>
					<?php echo $error; ?>
					<form class="form-horizontal" action="<?php echo site_url('kehadiran/update'); ?>" method="post">
						<input type="hidden" name="idkehadiran" value="<?php echo $idkehadiran?>">
						<div class="form-group">
							<label class="col-xs-3">Keterangan</label>
							<div class="col-xs-6">
								<select name="keterangan" class="form-control" required>
									<option value="">Pilih Keterangan</option>
									<option value="Hadir">Hadir</option>
									<option value="Tidak Hadir">Tidak Hadir</option>
									<option value="Izin">Izin</option>
									<option value="Izin">Telat</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-xs-3">NIP Pegawai</label>
							<div class="col-xs-6">
								<input type="text" readonly="readonly" value="<?php echo $pegawai_nip?>" class="form-control"> 
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
							<td>&nbsp;</td><td>&nbsp;</td><td><input type="submit" class="btn btn-success" value="Simpan" name="update"> <input type="reset" class="btn btn-danger" value="Batal"></td>
						</tr>
					</table>
					<?php echo form_close();?>
					<?php echo validation_errors(); ?>
				</div>
				</div>
				</div>
				</div><!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->

						
					