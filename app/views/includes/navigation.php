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
        <!-- <div class="dropdown-title">Logged in 5 min ago</div> -->
        <a href="<?php echo URLROOT . '/users/show/' . $_SESSION['user_id'] ?>" class="dropdown-item has-icon">
          <i class="far fa-user"></i> Profile
        </a>
        <!-- <a href="features-activities.html" class="dropdown-item has-icon">
          <i class="fas fa-bolt"></i> Activities
        </a> -->
        <!-- <a href="features-settings.html" class="dropdown-item has-icon">
          <i class="fas fa-cog"></i> Settings
        </a> -->
        <div class="dropdown-divider"></div>

        <a href="<?php echo URLROOT; ?>/users/logout" class="dropdown-item has-icon text-danger">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      </div>
    </li>
  </ul>
</nav>