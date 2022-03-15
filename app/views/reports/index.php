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

            <!-- Filter Data by Report Created -->
            <div class="col-md-8 mb-2">
              <h5><b> Filter Berdasarkan Waktu Dilaporkan </b></h5>
                <form action="<?php echo URLROOT ?>/reports/index"  method="POST">
                    <label for="">Dari</label>
                    <input style="width: 35%; display: inline;" type="date" class="form-control" placeholder="Mulai" name="date1" 
                    value="<?php echo isset($_POST['date1']) ? $POST['date1'] : '' ?>">
                    <label for="">Sampai</label>
                    <input style="width: 35%; display: inline;" type="date" class="form-control" placeholder="Sampai" name="date2" 
                    value="<?php echo isset($_POST['date2']) ? $POST['date2'] : '' ?>">
                    <button type="submit" class="btn btn-primary"><span class="fas fa-search"></span></button>
                    <a href="<?php echo URLROOT; ?>/reports"><button type="button" class="btn btn-success"><span class="fas fa-refresh"></span></button></a>
                </form>
            </div>
              
            <div class="col-md-4">
              <div class="text-right">

                <!-- Button Keterangan Status -->
                <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#keteranganStatusModal"> 
                  <i class="fas fa-question"></i>
                  Keterangan Status
                </button>
                
                <!-- Button Buat Laporan -->
                <a href="<?php echo URLROOT ?>/reports/create"> 
                  <button class="btn btn-primary mb-2"><i class="fas fa-file-alt">
                    </i> <span>Buat Laporan</span> </button></a>
                    
              </div>
            </div>
                      
          </div>
          
          <?php 
          // var_dump($_POST['date1']);
          // var_dump($_POST['date2']);
          // var_dump($);
          
          ?>

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
                  <td>
                    <span class="badge <?php echo $report->status_laporan == 'MASUK' ? 'bg-info' : ( $report->status_laporan == 'PROSES TAHAP 1' || $report->status_laporan == 'PROSES - P18' || $report->status_laporan == 'PROSES - P19' || $report->status_laporan == 'PROSES - P21' || $report->status_laporan == 'PROSES TAHAP 2' ?  'bg-primary' :  ($report->status_laporan == 'SELESAI PUTUSAN' ? 'bg-success' : ( $report->status_laporan == 'CANCEL' ? 'bg-danger' : '')) ); ?>" 
                          style="color: white">
                      <?php echo $report->status_laporan ?>
                    </span></td>
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

      <!-- Modal Keterangan Status-->
      <div class="modal fade" id="keteranganStatusModal" tabindex="-1" aria-labelledby="keteranganStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="keteranganStatusModalLabel">Keterangan Status</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p><span class="badge bg-info" style="color: white;">MASUK </span> Laporan baru masuk ke dalam list laporan </p>
              <p><span class="badge bg-primary" style="color: white;">PROSES TAHAP 1 </span> Pengiriman berkas perkara ke kejaksaan </p>
              <p><span class="badge bg-primary" style="color: white;">PROSES - P18 </span> Berkas belum lengkap </p>
              <p><span class="badge bg-primary" style="color: white;">PROSES - P19</span> Pengembalian berkas perkara untuk dilengkapi </p>
              <p><span class="badge bg-primary" style="color: white;">PROSES - P21 </span> Berkas Perkara Lengkap </p>
              <p><span class="badge bg-primary" style="color: white;">PROSES TAHAP 2 </span> Pelimpahan tersangka ke kejaksaan </p>
              <p><span class="badge bg-success" style="color: white;">SELESAI PUTUSAN </span> Keputusan pengadilan telah ditetapkan laporan selesai </p>
              <p><span class="badge bg-danger" style="color: white;"> CANCEL </span> Laporan dibatalkan karena hal-hal tertentu </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>


  <?php
  require APPROOT . '/views/includes/footer.php';
  ?>