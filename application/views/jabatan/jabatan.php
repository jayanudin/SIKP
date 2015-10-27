
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
										<a href="<?php echo base_url();?>jabatan/tambah" class="btn btn-primary"><i class="fa fa-plus-square"></i> Tambah Data</a>

									

						<p>&nbsp;</p>
						<div class="panel panel-success">
                        <div class="panel-heading">Data Jabatan</div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
										<tr>
											<th>#</th>
											<th>Jabatan</th>
											<th>Aksi</th>
										</tr>
									</thead>

										<?php

												$no = 1;
												foreach($query as $db)
												{
										?>
										<tbody>
											<tr>
												<td><?php echo $no; ?></td>
												<td><?php echo $db->jabatan; ?></td>
												<td>
													<a title="hapus" href="<?php echo base_url(); ?>jabatan/delete/<?php echo $db->id_jabatan;?>" onclick="return confirm('Anda yakin akan menghapus data <?php echo $db->jabatan;?> ?');" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
													<a title="update" href="<?php echo base_url(); ?>jabatan/edit/<?php echo $db->id_jabatan;?>"  class="btn btn-warning"><i class="fa fa-wrench"></i></a>
												</td>
											</tr>
											<?php
											$no++;
										}
									
									?>
											
									</tbody>                                        
                                </table>
                            </div>
                        </div>
				</div><!-- /.row (main row) -->
			</div>
             </section><!-- /.content -->
          </aside><!-- /.right-side -->
<?php get_footer();?>