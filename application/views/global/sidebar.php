<div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo base_url();?>assets/img/logo.png" alt="Target Admin">
                        </div>
                        <div class="pull-left info">
                            <p>Selamat Datang</p>
                        </div>
                    </div>
                    
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li>
                            <a href="<?php echo base_url();?>app">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo base_url();?>pegawai">
                                <i class="fa fa-users"></i> <span>Pegawai</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>kehadiran">
                                <i class="fa fa-check-square-o"></i> <span>Kehadiran</span>
                            </a>
                        </li>
                        <!-- <li>
                            <a href="<?php echo base_url();?>operasional">
                                <i class="fa fa-clock-o"></i> <span>Waktu Operasional</span>
                            </a>
                        </li> -->
                        <li>
                            <a href="<?php echo base_url();?>ketetapan_jam">
                                <i class="fa fa-gear"></i> <span>Ketetapan Jam Kerja</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>jabatan">
                                <i class="fa fa-suitcase"></i> <span>Jabatan</span>
                            </a>
                        </li>
                         <li>
                            <a href="<?php echo base_url();?>akademik">
                                <i class="fa fa-calendar"></i> <span>Tahun Akademik</span>
                            </a>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-print"></i>
                                <span>Cetak Laporan</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                  <li><a href="<?php echo base_url();?>report"><i class="fa fa-angle-double-right"></i>Kehadiran Per Periode</a></li>
                                  <li><a href="<?php echo base_url();?>report/per_day"><i class="fa fa-angle-double-right"></i>Kehadiran Per Hari</a></li>
                                  <li><a href="<?php echo base_url();?>report/per_pegawai"><i class="fa fa-angle-double-right"></i>Kehadiran Per Pegawai</a></li>
                                  <li><a href="<?php echo base_url();?>report/dinas_per_periode"><i class="fa fa-angle-double-right"></i>Dinas Per Periode</a></li>
                            </ul>
                        </li>
                         <li>
                            <a href="<?php echo base_url();?>user">
                                <i class="fa fa-wrench"></i> <span>Pengaturan</span>
                            </a>
                        </li>
                        
                    </ul>
                </section>
            </aside>

                <!-- /.sidebar -->
           

        <!-- add new calendar event modal -->
