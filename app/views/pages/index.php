<?php
require APPROOT . '/views/includes/head.php';
// $page = 'home';
?>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
          <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
          </div>

        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <!-- <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle mr-1"> -->
              <div class="d-sm-none d-lg-inline-block"><?php echo $_SESSION['username']; ?></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">Logged in 5 min ago</div>
              <a href="features-profile.html" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <a href="features-activities.html" class="dropdown-item has-icon">
                <i class="fas fa-bolt"></i> Activities
              </a>
              <a href="features-settings.html" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Settings
              </a>
              <div class="dropdown-divider"></div>

              <a href="<?php echo URLROOT; ?>/users/logout" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>

            <li class="menu-header">Starter</li>
            <li <?php $page = 'home';
                if ($page == 'home') {
                  echo 'class="active"';
                } ?>><a class="nav-link " href="blank.html"><i class="far fa-square"></i> <span>Blank Page</span></a></li>
          </ul>

          <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
              <i class="fas fa-rocket"></i> Documentation
            </a>
          </div>
        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Dashboard</h1>
          </div>
          <div class="row">

            <?php var_dump($_SESSION['email']) ?>
            <?php var_dump($_SESSION['username']) ?>


          </div>
      </div>
      </section>

      <footer class="main-footer">
        <div class="footer-left col-md-6">
          Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
        </div>
        <div class="footer-right col-md-3">
          2.3.0
        </div>

        <div class="col-md-12">
          Distributed by <a href="https://themewagon.com/">Themewagon</a>
        </div>
      </footer>
    </div>
  </div>
  </div>

  <?php
  require APPROOT . '/views/includes/footer.php';
  ?>