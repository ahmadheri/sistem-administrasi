<?php
require APPROOT . '/views/includes/head.php';

// login check for user
if (!isLoggedIn()) {
  header('location: '  . URLROOT . '/users/login');
  exit();
}

// declare this page
$page = 'home';

sessionTimeChecked();

?>

<body>
  <div id="app">
    <div class="main-wrapper">
      <?php require APPROOT . '/views/includes/navigation.php' ?>

      <?php require APPROOT . '/views/includes/sidebar.php' ?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Dashboard</h1>
          </div>
          <div class="row">
            
            <!-- Flash Message -->
            <div class="col-lg-12">
              <?php if (isset($_SESSION['success'])) {
              ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['success']  ?> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <?php  
              unset($_SESSION['success']);
              }
              ?>
            </div>            

          </div>

          <div class="row">

            <!-- Statistik Pengguna -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total User</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $data['userCount'] ?>
                  </div>
                </div>
              </div>
            </div>

            

            <!-- Statistik Penduduk -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Penduduk</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $data['residentCount'] ?>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <!-- row pertama -->

          <hr>
          <h5>Statistik Laporan</h5>

          <!-- row kedua -->
          <div class="row">

            <!-- Statistik Total Laporan -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Laporan</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $data['reportCount'] ?>
                  </div>
                </div>
              </div>
            </div>

            <!-- Statistik Laporan Masuk -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Laporan Masuk</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $data['totalReportsIn'] ?>
                  </div>
                </div>
              </div>
            </div>

            <!-- Statistik Laporan Proses -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-info">
                  <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Laporan Proses</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $data['totalReportsOnProcess'] ?>
                  </div>
                </div>
              </div>
            </div>

            <!-- Statistik Laporan Selesai -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Laporan Selesai</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $data['totalReportsDone'] ?>
                  </div>
                </div>
              </div>
            </div>

            <!-- Statistik Laporan Selesai -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Laporan Cancel</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $data['totalReportsCancel'] ?>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <!-- row kedua -->
            
        </section>
      </div>

      
    </div>
  </div>
  </div>

  <?php
  require APPROOT . '/views/includes/footer.php';
  ?>