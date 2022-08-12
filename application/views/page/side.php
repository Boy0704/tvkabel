<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="image/user/<?php echo $this->session->userdata('foto'); ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('nama'); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        
          
        
        <li><a href="app"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        
        <?php if ($this->session->userdata('level')=='admin'): ?>
        <li><a href="pelanggan"><i class="fa fa-user"></i> <span>Master Pelanggan</span></a></li>
        <li><a href="layanan"><i class="fa fa-cube"></i> <span>Master Layanan</span></a></li>
        <li><a href="wilayah"><i class="fa fa-cube"></i> <span>Master Wilayah</span></a></li>
        
        <li><a href="rt"><i class="fa fa-bank"></i> <span>Data RT</span></a></li>
        <li><a href="rw"><i class="fa fa-bank"></i> <span>Data RW</span></a></li>
        <li><a href="tahun"><i class="fa fa-bank"></i> <span>Data Tahun</span></a></li>
        <li><a href="app/tagihan_pelanggan"><i class="fa fa-cart-plus"></i> <span>Tagihan Pelanggan</span></a></li>
        <!-- <li><a href="#app/laporan_pelanggan"><i class="fa fa-external-link-square"></i> <span>Laporan Pelanggan</span></a></li> -->
        <li><a href="app/pembukuan?tgl1=<?php echo date('Y-m-d') ?>&tgl2=<?php echo date('Y-m-d') ?>&sorting=created_at&id_wilayah=&kolektor="><i class="fa fa-print"></i> <span>Pembukuan</span></a></li>
        <li><a href="app/statistik/bulan?id_wilayah=&bulan=<?php echo date('m') ?>&tahun=<?php echo date('Y') ?>"><i class="fa fa-pie-chart"></i> <span>Statistik</span></a></li>
        <li><a href="a_user"><i class="fa fa-users"></i> <span>Master User</span></a></li>
        <li><a href="login/logout"><i class="fa fa-sign-out"></i> <span>Keluar</span></a></li>

         <?php endif ?>
         <?php if ($this->session->userdata('level')=='kolektor'): ?>
         <li><a href="app/tagihan_pelanggan"><i class="fa fa-cart-plus"></i> <span>Tagihan Pelanggan</span></a></li>
         <li><a href="login/logout"><i class="fa fa-sign-out"></i> <span>Keluar</span></a></li>
        <?php endif ?>
       
        
        

        <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Faqs</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Tentang Aplikasi</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>