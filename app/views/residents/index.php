<?php 
require APPROOT . '/views/includes/head.php';

if (!isLoggedIn()) {
    header('location: '  . URLROOT . '/users/login');
    exit();
  }
$page = 'residents';

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
            <h1>Daftar Penduduk</h1>
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
                <a href="<?php echo URLROOT ?>/residents/create"> 
                <button class="btn btn-primary mb-2"><i class="fas fa-file-alt">
                </i> <span>Tambah Penduduk</span> </button></a>
              </div>
            </div>
          </div>
          
          <div class="card card-table">
            <!-- Table for showing data -->
            <table id="table-data" class="table table-bordered " >
              <thead>
                <tr>
                  <th><b>No Identitas</b></th>
                  <th><b>Nama Penduduk</b></th>
                  <th><b>Tempat Lahir</b></th>
                  <th><b>Tanggal Lahir</b></th>
                  <th><b>Jenis Kelamin</b></th>
                  <th><b>Alamat</b></th>
                  <th><b>Aksi</b></th>
                </tr>
              </thead>
              <tbody>
                

                <?php

                  foreach ($data['residents'] as $resident) {
                ?>

                <tr>
                  <td><?php echo $resident->no_identitas ?></td>
                  <td><?php echo $resident->nama ?></td>
                  <td><?php echo $resident->tempat_lahir ?></td>
                  <td><?php echo strftime('%A %d %B %Y', strtotime($resident->tanggal_lahir)) ?></td>
                  <td><?php echo $resident->jenis_kelamin ?></td>
                  <td><?php echo $resident->alamat ?></td>
                  <td>
                    <a href="<?php echo URLROOT . '/residents/detail/' . $resident->id; ?>" 
                    class="btn btn-icon btn-light btn-sm">Detail</a>
                    
                    <!-- <a href="<?php echo URLROOT . '/residents/print/' . $resident->id; ?>" target="_blank" 
                    class="btn btn-icon btn-warning btn-sm">Print</a> -->

                    <a href="<?php echo URLROOT . '/residents/edit/' . $resident->id; ?>" 
                    class="btn btn-icon btn-info btn-sm">Edit</a>
                    
                    <form id="delete"
                      action="<?php echo URLROOT . '/residents/delete/' . $resident->id; ?>"
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