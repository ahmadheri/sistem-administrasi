<?php 
// HEADER
require APPROOT . '/views/includes/head.php';

if (!isLoggedIn()) {
  header('location: '  . URLROOT . '/users/login');
  exit();
}

$page = 'reports';
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
            <h1>Laporan</h1>
          </div>
          <div class="row">

            <div class="col-md-8">
              <div class="card">
                <div class="card-body">
                  
                  <p><strong>Nama Pelapor :</strong> <?php echo $data['report']->nama_pelapor ?></p>
                  <p><strong>Waktu Kejadian :</strong> <?php echo $data['report']->waktu_kejadian ?></p>
                  <p><strong>Tempat Kejadian :</strong> <?php echo $data['report']->tempat_kejadian ?></p>
                  <p><strong>Pelanggaran :</strong> <?php echo $data['report']->pelanggaran ?></p>
                  <p><strong>Pelaku :</strong> <?php echo $data['report']->pelaku ?></p>
                  <p><strong>Korban :</strong> <?php echo $data['report']->korban ?></p>
                  <p><strong>Deskripsi Kejadian :</strong> <?php echo $data['report']->deskripsi_kejadian ?></p>
                  <p><strong>Waktu Dilaporkan:</strong> <?php echo $data['report']->waktu_dilaporkan ?></p>
                  <p><strong>Status Laporan:</strong> <?php echo $data['report']->status_laporan ?></p>
                  <p><strong>Tindak Pidana:</strong> <?php echo $data['report']->tindak_pidana ?></p>
                  <p><strong>Nama Saksi:</strong> <?php echo $data['report']->nama_saksi ?></p>
                  <p><strong>Alamat Saksi :</strong> <?php echo $data['report']->alamat_saksi ?></p>
                  <p><strong>Barang Bukti:</strong> <?php echo $data['report']->barang_bukti ?></p>
                  <p><strong>Uraian Kejadian:</strong> <?php echo $data['report']->uraian_kejadian ?></p>
                  
                </div>
              </div>
            </div>


          </div>
        </section>
      </div>

<!-- FOOTER -->
<?php
require APPROOT . '/views/includes/footer.php';
?>
