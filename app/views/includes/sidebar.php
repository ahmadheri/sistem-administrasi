<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="index.html">Sistem Administrasi</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="index.html">Sa</a>
    </div>
    <ul class="sidebar-menu">
      <!-- <li class="menu-header">Dashboard</li> -->
      <li <?php
          if ($page == 'home') {
            echo 'class="active"';
          } ?>><a class="nav-link " href="<?php echo URLROOT; ?>/home">
          <i class="fas fa-fire"></i> <span>Dashboard</span></a>
      </li>
      <li <?php
          if ($page == 'reports') {
            echo 'class="active"';
          } ?>><a class="nav-link " href="<?php echo URLROOT; ?>/reports">
          <!-- <i class="fas fa-square"></i> <span>Reports</span></a> -->
          <i class="fas fa-file-alt"></i> <span>Laporan</span></a>
      </li>
      <li <?php
          if ($page == 'residents') {
            echo 'class="active"';
          } ?>><a class="nav-link " href="<?php echo URLROOT; ?>/residents">
          <!-- <i class="fas fa-square"></i> <span>Reports</span></a> -->
          <i class="fas fa-file-alt"></i> <span>Penduduk</span></a>
      </li>

      <!-- hide if role of user is not Admin -->
      <?php if ($_SESSION['role'] == 'Admin') {
        
      ?>
      <li <?php
          if ($page == 'users') {
            echo 'class="active"';
          } ?>><a class="nav-link " href="<?php echo URLROOT; ?>/users">
          <i class="fas fa-user"></i> <span>Users</span></a>
      </li>
      <?php } ?>
    </ul>

  </aside>
</div>