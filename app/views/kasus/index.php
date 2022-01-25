<?php 
require APPROOT . '/views/includes/head.php';

if (!isLoggedIn()) {
  header('location: '  . URLROOT . '/users/login');
  exit();
}
$page = 'cases';

?>

<body>
  <div class="app">
    <?php require APPROOT . '/views/includes/navigation.php' ?>
    <?php require APPROOT . '/views/includes/sidebar.php' ?>

    <div class="main-content">
      <section class="section">
        <div class="section-header custom-section-header">
          <h1>Daftar Kasus</h1>
        </div>

        <!-- Status Message -->
        <div class="row">

          <?php
          if (isset($_SESSION['status'])) :
          ?>
            <div class="alert alert-success" role="alert">
              <?php
              echo $_SESSION['status'];
              unset($_SESSION['status']);
              ?>
            </div>
          <?php
          endif;
          ?>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="text-right">
                <a href="<?php echo URLROOT ?>/cases/create"> 
                <button class="btn btn-primary mb-2"><i class="fas fa-file-alt">
                </i> <span>Buat Kasus</span> </button></a>
              </div>
            </div>
          </div>


          <div class="card card-table">
            <!-- Table for showing data -->
            <table id="table-data" class="table table-bordered " >
              <thead>
                <tr>
                  <th><b>Nama Kasus</b></th>
                  <th><b>Tempat Kejadian</b></th>
                  <th><b>Waktu Kejadian</b></th>
                  <th><b>Pelanggaran</b></th>
                  <th><b>Deskripsi Kejadian</b></th>
                  <th><b>Tindak Pidana</b></th>
                  <th><b>Barang Bukti</b></th>
                </tr>
              </thead>
              <tbody>
                

                <?php

                  foreach ($data['kasus'] as $kasus) {
                ?>

                <tr>
                  <td><?php echo $kasus->nama_pelapor ?></td>
                  <td><?php echo $kasus->tempat_kejadian ?></td>
                  <td><?php echo strftime('%A %d %B %Y, %H:%M', strtotime($kasus->waktu_kejadian))  ?></td>
                  <td><?php echo $kasus->pelanggaran ?></td>
                  <td><?php echo substr($kasus->deskripsi_kejadian, 0, 50)  ?></td>
                  <td><?php echo $kasus->tindak_pidana ?></td>
                  <td><?php echo $kasus->barang_bukti ?></td>
                  <td>
                    <a href="<?php echo URLROOT . '/cases/show/' . $kasus->id; ?>" 
                    class="btn btn-icon btn-light btn-sm">Detail</a>

                    <a href="<?php echo URLROOT . '/cases/print/' . $kasus->id; ?>" target="_blank" 
                    class="btn btn-icon btn-warning btn-sm">Print</a>

                    <a href="<?php echo URLROOT . '/cases/edit/' . $kasus->id; ?>" 
                    class="btn btn-icon btn-info btn-sm">Edit</a>

                    <form id="delete"
                      action="<?php echo URLROOT . '/cases/delete/' . $kasus->id; ?>"
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

  </div>
</body>

<?php
require APPROOT . '/views/includes/footer.php';
?>