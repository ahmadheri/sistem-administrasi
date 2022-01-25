<?php
require APPROOT . '/views/includes/head.php';

if (!isLoggedIn()) {
  header('location: '  . URLROOT . '/users/login');
  exit();
}
$page = 'reports';

// check session
sessionTimeChecked();

// Set default timezone to WITA
date_default_timezone_set('Asia/Makassar');

// set locale language
setlocale(LC_ALL, 'IND.UTF-8');
?>

<body>
  <div id="app">
    <div class="main-wrapper">
      <?php require APPROOT . '/views/includes/navigation.php' ?>
      <?php require APPROOT . '/views/includes/sidebar.php' ?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header custom-section-header">
            <h1>Daftar Laporan</h1>
          </div>
          
          <div class="row">
            
            <!-- Flash Message -->
            <div class="col-lg-12">
              <?php if (isset($_SESSION['success'])) {
              ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['success'] ?> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <?php  
              }
              ?>
            </div> 

          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="text-right">
                <a href="<?php echo URLROOT ?>/reports/create"> 
                <button class="btn btn-primary mb-2"><i class="fas fa-file-alt">
                </i> <span>Buat Laporan</span> </button></a>
              </div>
            </div>
          </div>
          
          <div class="card card-table">
            <!-- Table for showing data -->
            <table id="table-data" class="table table-bordered " >
              <thead>
                <tr>
                  <th><b>Nama Pelapor</b></th>
                  <th><b>Waktu Kejadian</b></th>
                  <th><b>Tempat Kejadian</b></th>
                  <th><b>Pelanggaran</b></th>
                  <th><b>Waktu Dilaporkan</b></th>
                  <th><b>Status</b></th>
                  <th><b>Aksi</b></th>
                </tr>
              </thead>
              <tbody>
                

                <?php

                  foreach ($data['reports'] as $report) {
                ?>

                <tr>
                  <td><?php echo $report->nama_pelapor ?></td>
                  <td><?php echo strftime('%A %d %B %Y, %H:%M', strtotime($report->waktu_kejadian))  ?></td>
                  <td><?php echo $report->tempat_kejadian ?></td>
                  <td><?php echo $report->pelanggaran ?></td>
                  <td><?php echo strftime('%A %d %B %Y, %H:%M', strtotime($report->waktu_dilaporkan)) ?></td>
                  <td><?php echo $report->status ?></td>
                  <td>
                    <a href="<?php echo URLROOT . '/reports/show/' . $report->id; ?>" 
                    class="btn btn-icon btn-light btn-sm">Detail</a>
                    
                    <a href="<?php echo URLROOT . '/reports/print/' . $report->id; ?>" target="_blank" 
                    class="btn btn-icon btn-warning btn-sm">Print</a>

                    <a href="<?php echo URLROOT . '/reports/edit/' . $report->id; ?>" 
                    class="btn btn-icon btn-info btn-sm">Edit</a>
                    
                    <form id="delete"
                      action="<?php echo URLROOT . '/reports/delete/' . $report->id; ?>"
                      method="POST"
                      onclick="return confirm('Hapus laporan ini permanent?')"
                      style="display: inline;">                  
                      <input type="submit" name="delete" value="Delete" 
                      class="btn btn-icon btn-danger btn-sm" >
                    </form>
                  </td>
                </tr>
                <?php
                  }
                ?>


              </tbody>
            </table>
          </div>

        </section>
      </div>


  <?php
  require APPROOT . '/views/includes/footer.php';
  ?>