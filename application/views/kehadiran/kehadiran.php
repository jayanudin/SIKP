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
					<a href="<?php echo base_url();?>kehadiran/tambah" class="btn btn-primary"><i class="fa fa-plus-square"></i> Tambah Data</a>
									

					
					<div class="panel-heading">
                            <table>
                            	<tr>
                            		<td><h5>Tampilkan Berdasarkan </h5></td><td>&nbsp;</td>
                            		<form method="POST" action="<?php echo site_url('kehadiran/status_pegawai');?>">
                            			<td>
                            			<select name="status" class="form-control">
                            				<option value="">--Pilih Status Pegawai--</option>
                            				<option value="Pengajar">Pengajar</option>
                            				<option value="Non Pengajar">Non Pengajar</option>
                            			</select>
                            		</td>
                            		<td><input type="submit" name="submit" class="btn btn-info" value="submit"></td>
                            		</form>
                            	</tr>
                            	<tr>
                            		<td><h5>Tampilkan Pada Tanggal </h5></td><td>&nbsp;</td>
                            		<form method="POST" action="<?php echo site_url('kehadiran/per_hari');?>">
                            			<td>
                            			<input type="text" name="tanggal_masuk" required placeholder="Masukan Tanggal" id="datepicker" class="form-control" />
                            		</td>
                            		<td><input type="submit" name="submit" class="btn btn-info" value="submit"></td>
                            		</form>
                            	</tr>
                            </table>
                        </div>
                        <div class="panel panel-success">
                        <div class="panel-heading">Data Kehadiran</div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    
                                    <thead>
										<tr>
											
                                            <th>#</th>
											<th>Hari & Tanggal</th>
											<th>NIP</th>
											<th>Nama Pegawai</th>
											<th>Waktu Masuk</th>
											<th>Waktu Keluar</th>
											<th>keterangan</th>
											<th>Tahun Akademik</th>
											<th>Status</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>

                                        
										<?php

												$no = 1;

												foreach($query as $db):
										?>
											<tr>
												 
                                                
                                                <td><?php echo $no; ?></td>
												<td><?php echo $db->hari; ?>, <?php echo $db->tanggal_masuk; ?></td>
												<td><?php echo $db->pegawai_nip; ?></td>
												<td><?php echo $db->nama_pegawai; ?></td>
												<td><?php echo $db->waktu_masuk; ?></td>
												<td><?php echo $db->waktu_keluar; ?></td>
                                                        <?php $attr = $db->keterangan;?>
                                                        <?php if ($attr == "Hadir") { ?>
                                                           <td><div class="status-hadir"><p><?php echo $attr; ?></p></div></td>
                                                        <?php }elseif ($attr == "Izin"){?>
                                                             <td><div class="status-izin"><p><?php echo $attr; ?></p></div></td>
                                                        <?php }elseif ($attr == "Telat"){?>
                                                             <td><div class="status-telat"><p><?php echo $attr; ?></p></div></td>
                                                        <?php }else{ ?>
                                                            <td><div class="status-tidak-hadir"><p><?php echo $attr; ?></p></div></td>
                                                        <?php }?>
												<td><?php echo $db->tahun_akademik; ?></td>
												<td><?php echo $db->status; ?></td>
												<td><a title="hapus" href="<?php echo base_url(); ?>kehadiran/delete/<?php echo $db->idkehadiran;?>" 
													onclick="return confirm('Anda yakin akan menghapus data <?php echo $db->idkehadiran;?> ?');" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
													<a title="update" href="<?php echo base_url(); ?>kehadiran/edit/<?php echo $db->idkehadiran;?>"  class="btn btn-warning"><i class="fa fa-wrench"></i></a>
												</td>
											</tr>
											<?php
											$no++;
											endforeach;
									
									?>
                                    
									</tbody>      

                                </table>
                               
                            </div>
                        </div>
                    </div>
				  </section><!-- /.content -->
            </aside><!-- /.right-side -->
<?php get_footer();?>