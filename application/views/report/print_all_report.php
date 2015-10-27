<?php echo get_header();?>
		<link rel="stylesheet" href="<?php echo base_url();?>assets/datepicker/css/datepicker.css">
        <script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                
                $('#datepicker1').datepicker({
                   format: "yyyy-mm-dd"
                }); 
                $('#datepicker2').datepicker({
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
              <div class="row">
					<div class="col-md-8">
						<div class="panel panel-success">
                        	<div class="panel-heading">Print Semua Data Kehadiran</div>
                        		<div class="panel-body">
					<?php error_reporting(0);?>
					<?php echo $error; ?>
					<form class="form-horizontal" action="<?php echo base_url(); ?>report/print_all_data" method="post">
						<div class="form-group">
							<label class="col-xs-3">Status Pegawai</label>
							<div class="col-xs-6">
                            	<select name="status" class="form-control">
                            		<option value="">--Pilih Status Pegawai--</option>
                            		<option value="Pengajar">Pengajar</option>
                            		<option value="Non Pengajar">Non Pengajar</option>
                            	</select>
                            </div>
                        </div>

                        <div class="form-group">
							<label class="col-xs-3">Dari Tanggal</label>
							<div class="col-xs-6">
								<input type="text" name="tanggal_awal" required placeholder="Masukan Tanggal Awal" id="datepicker1" class="form-control" />
							 </div>
                        </div>

						<div class="form-group">
							<label class="col-xs-3">Sampai Tanggal</label>
							<div class="col-xs-6">
								<input type="text" name="tanggal_akhir" required placeholder="Masukan Tanggal Akhir" id="datepicker2" class="form-control" />
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
                        	<div class="panel-heading">Cetak</div>
                        		<div class="panel-body">
                        			<table>
                        				<tr>
											<td>&nbsp;</td><td>&nbsp;</td><td><input type="submit" class="btn btn-success" value="Cetak" name="submit"> <input type="reset" class="btn btn-danger" value="Batal"></td>
										</tr>
                        			</table>
                        		</div>
                        	</div>
                        </div>
                        <?php echo form_close();?>
						<?php echo validation_errors(); ?>
				</div><!-- /.row (main row) -->
              </section><!-- /.content -->
           </aside><!-- /.right-side -->

<?php echo get_footer();?>

						
					