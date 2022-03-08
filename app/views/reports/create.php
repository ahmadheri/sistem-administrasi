<?php 
require_once APPROOT . '/views/includes/head.php';
require_once APPROOT . '/views/reports/create.php';

if (!isLoggedIn()) {
  header('location: ' . URLROOT . '/users/login');
  exit();
}

$page = 'reports';

sessionTimeChecked();
?>

<body>
  <div id="app">

    <div class="main-wrapper">
      <?php require_once APPROOT . '/views/includes/navigation.php' ?>
      <?php require_once APPROOT . '/views/includes/sidebar.php' ?>
  
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Buat Laporan</h1>
          </div>

          <div class="row">
            
            <!-- Form create user -->
            <div class="col-12 col-md-12 col-lg-12">
              <form action="<?php echo URLROOT ?>/reports/create" method="POST">
                <div class="card">
                  <div class="card-header">
                    <h4>Create Report</h4>
                  </div>

                  <div class="card-body">

                    <div class="form-group">    
                      <label>Nama Pelapor</label>
                      <div class="input-group mb-3">
                        <input type="text" class="form-control <?php echo $data['namaPelaporError'] ?  'is-invalid' :  '' ?>"
                        id="nama_pelapor" name="nama_pelapor" placeholder="Cari nama pelapor" aria-label="Cari nama pelapor"
                        value="<?= isset($_POST['nama_pelapor']) ? $_POST['nama_pelapor'] : ''; ?>">
                        <div class="input-group-append">
                          <button id="search-name" class="btn btn-outline-primary" type="button"
                          data-target="#search-name-modal" data-toggle="modal">
                            Search 
                          </button>
                        </div>
                        <div class="invalid-feedback">
                          <?php echo $data['namaPelaporError']; ?>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Waktu Kejadian</label>
                      <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input <?php echo $data['waktuKejadianError'] ?  'is-invalid' :  '' ?>" 
                        data-target="#datetimepicker1" id="waktu_kejadian" name="waktu_kejadian" placeholder="Pilih waktu kejadian" 
                        value="<?= isset($_POST['waktu_kejadian']) ? $_POST['waktu_kejadian'] : ''; ?>" />
                        <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                        <div class="invalid-feedback">
                          <?php echo $data['waktuKejadianError']; ?>
                        </div>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label>Tempat Kejadian</label>
                      <input type="text" class="form-control <?php echo $data['tempatKejadianError'] ?  'is-invalid' :  '' ?>" 
                      id="tempat_kejadian" name="tempat_kejadian" placeholder="Isi tempat lokasi kejadian" 
                      value="<?= isset($_POST['tempat_kejadian']) ? $_POST['tempat_kejadian'] : ''; ?>">
                      <div class="invalid-feedback">
                        <?php echo $data['tempatKejadianError']; ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Pelanggaran</label>
                      <input type="text" class="form-control <?php echo $data['pelanggaranError'] ?  'is-invalid' :  '' ?>" 
                      id="pelanggaran" name="pelanggaran" placeholder="Pelanggaran apa yang dilakukan"
                      value="<?= isset($_POST['pelanggaran']) ? $_POST['pelanggaran'] : ''; ?>">
                      <div class="invalid-feedback">
                        <?php echo $data['pelanggaranError']; ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Pelaku / Terlapor</label>
                      <div class="input-group mb-3">
                        <input type="text" class="form-control <?php echo $data['pelakuError'] ?  'is-invalid' :  '' ?>" 
                        id="pelaku" name="pelaku" placeholder="Cari nama pelaku atau terlapor" aria-label="Cari nama pelaku atau terlapor"
                        value="<?= isset($_POST['pelaku']) ? $_POST['pelaku'] : ''; ?>">
                        <div class="input-group-append">
                          <button id="search-pelaku" class="btn btn-outline-primary" type="button"
                          data-target="#search-pelaku-modal" data-toggle="modal">
                            Search 
                          </button>
                        </div>
                        <div class="invalid-feedback">
                          <?php echo $data['pelakuError']; ?>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Korban</label>
                      <div class="input-group mb-3">
                        <input type="text" class="form-control <?php echo $data['korbanError'] ?  'is-invalid' :  '' ?>" 
                        id="korban" name="korban" placeholder="Cari nama korban" aria-label="Cari nama korban"
                        value="<?= isset($_POST['korban']) ? $_POST['korban'] : ''; ?>">
                        <div class="input-group-append">
                          <button id="search-korban" class="btn btn-outline-primary" type="button"
                          data-target="#search-korban-modal" data-toggle="modal">
                            Search
                          </button>
                        </div>
                        <div class="invalid-feedback">
                          <?php echo $data['korbanError']; ?>
                        </div>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label>Deskripsi Kejadian</label>
                      <textarea rows="5" style="height: 100%;" class="form-control <?php echo $data['deskripsiKejadianError'] ?  'is-invalid' :  '' ?>" 
                      id="deskripsi_kejadian" name="deskripsi_kejadian" placeholder="Isi kronologi kejadian"><?= isset($_POST['deskripsi_kejadian']) ? $_POST['deskripsi_kejadian'] : ''; ?></textarea>
                      <div class="invalid-feedback">
                        <?php echo $data['deskripsiKejadianError']; ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Waktu Dilaporkan</label>
                      <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input <?php echo $data['waktuDilaporkanError'] ?  'is-invalid' :  '' ?>" 
                        data-target="#datetimepicker2" id="waktu_dilaporkan" name="waktu_dilaporkan" placeholder="Pilih waktu ketika laporan dibuat"
                        value="<?= isset($_POST['waktu_dilaporkan']) ? $_POST['waktu_dilaporkan'] : ''; ?>"/>
                        <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                        <div class="invalid-feedback">
                          <?php echo $data['waktuDilaporkanError']; ?>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Tindak Pidana</label>
                      <input type="text" class="form-control <?php echo $data['tindakPidanaError'] ?  'is-invalid' :  '' ?>" 
                      id="tindak_pidana" name="tindak_pidana" placeholder="Pasal yang dikenakan"
                      value="<?= isset($_POST['tindak_pidana']) ? $_POST['tindak_pidana'] : ''; ?>">
                      <div class="invalid-feedback">
                        <?php echo $data['tindakPidanaError']; ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Nama Saksi</label>
                      <div class="input-group mb-3">
                        <input type="text" class="form-control <?php echo $data['namaSaksiError'] ?  'is-invalid' :  '' ?>" 
                        id="nama_saksi" name="nama_saksi" placeholder="Cari nama saksi" aria-label="Cari nama saksi"
                        value="<?= isset($_POST['nama_saksi']) ? $_POST['nama_saksi'] : ''; ?>">
                        <div class="input-group-append">
                          <button id="search-saksi" class="btn btn-outline-primary" type="button"
                          data-target="#search-saksi-modal" data-toggle="modal">
                            Search
                          </button>
                        </div>
                        <div class="invalid-feedback">
                          <?php echo $data['namaSaksiError']; ?>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Alamat Saksi</label>
                      <input type="text" class="form-control <?php echo $data['alamatSaksiError'] ?  'is-invalid' :  '' ?>" 
                      id="alamat_saksi" name="alamat_saksi" placeholder="Alamat saksi" 
                      value="<?= isset($_POST['alamat_saksi']) ? $_POST['alamat_saksi'] : ''; ?>">
                      <div class="invalid-feedback">
                        <?php echo $data['alamatSaksiError']; ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Barang Bukti</label>
                      <input type="text" class="form-control <?php echo $data['barangBuktiError'] ?  'is-invalid' :  '' ?>" 
                      id="barang_bukti" name="barang_bukti" placeholder="Barang bukti pelaku" autocomplete="off"
                      value="<?= isset($_POST['barang_bukti']) ? $_POST['barang_bukti'] : ''; ?>">
                      <div class="invalid-feedback">
                        <?php echo $data['barangBuktiError']; ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Uraian Kejadian</label>
                      <textarea rows="5" style="height: 100%;" class="form-control <?php echo $data['uraianKejadianError'] ?  'is-invalid' :  '' ?>" 
                      id="uraian_kejadian" name="uraian_kejadian" placeholder="Uraian lengkap kejadian"><?= isset($_POST['uraian_kejadian']) ? $_POST['uraian_kejadian'] : ''; ?></textarea>
                      <div class="invalid-feedback">
                        <?php echo $data['uraianKejadianError']; ?>
                      </div>
                    </div>


                  </div>
                  <div class="card-footer text-right">
                    <button class="btn btn-primary mr-1" id="create-report" type="submit">Submit</button>
                    <button class="btn btn-secondary" type="reset">Reset</button>
                  </div>
                </div>
              </form>
            </div>

          </div>
        </section>
      </div>


<!-- Modal Cari Nama Pelapor -->
<div class="modal fade" id="search-name-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Cari Nama Pelapor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id="table-nama" class="table table-bordered">
          <thead>
            <tr>
              <th>No Identitas</th>
              <th>Nama</th>
              <th>Alamat</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
              <?php 
                foreach ($data['residents'] as $resident) {
              ?>
              
              <tr>
                <td><?php echo $resident->no_identitas ?></td>
                <td><?php echo $resident->nama ?></td>
                <td><?php echo $resident->alamat ?></td>
                <td>
                  <button class="btn btn-icon btn-info btn-sm" id="select-nama"
                    data-id="<?php echo $resident->id ?>"
                    data-name="<?php echo $resident->nama ?>"  
                  >
                    <i class="fa fa-check"></i> Pilih
                  </button>
                </td>
              </tr>              
              
              <?php
                }
              ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Modal Cari Nama Pelapor -->

<!-- Modal Cari Nama Pelaku atau Terlapor -->
<div class="modal fade" id="search-pelaku-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Cari Nama Pelaku / Terlapor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id="table-pelaku" class="table table-bordered">
          <thead>
            <tr>
              <th>No Identitas</th>
              <th>Nama</th>
              <th>Alamat</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
              <?php 
                foreach ($data['residents'] as $resident) {
              ?>
              
              <tr>
                <td><?php echo $resident->no_identitas ?></td>
                <td><?php echo $resident->nama ?></td>
                <td><?php echo $resident->alamat ?></td>
                <td>
                  <button class="btn btn-icon btn-info btn-sm" id="select-pelaku"
                    data-id="<?php echo $resident->id ?>"
                    data-name="<?php echo $resident->nama ?>"  
                  >
                    <i class="fa fa-check"></i> Pilih
                  </button>
                </td>
              </tr>              
              
              <?php
                }
              ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Modal Cari Nama Pelaku atau Terlapor -->

<!-- Modal Cari Nama Korban -->
<div class="modal fade" id="search-korban-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Cari Nama Korban</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id="table-korban" class="table table-bordered">
          <thead>
            <tr>
              <th>No Identitas</th>
              <th>Nama</th>
              <th>Alamat</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
              <?php 
                foreach ($data['residents'] as $resident) {
              ?>
              
              <tr>
                <td><?php echo $resident->no_identitas ?></td>
                <td><?php echo $resident->nama ?></td>
                <td><?php echo $resident->alamat ?></td>
                <td>
                  <button class="btn btn-icon btn-info btn-sm" id="select-korban"
                    data-id="<?php echo $resident->id ?>"
                    data-name="<?php echo $resident->nama ?>"  
                  >
                    <i class="fa fa-check"></i> Pilih
                  </button>
                </td>
              </tr>              
              
              <?php
                }
              ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Modal Cari Nama Korban -->

<!-- Modal Cari Nama Saksi -->
<div class="modal fade" id="search-saksi-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Cari Nama Korban</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id="table-saksi" class="table table-bordered">
          <thead>
            <tr>
              <th>No Identitas</th>
              <th>Nama</th>
              <th>Alamat</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
              <?php 
                foreach ($data['residents'] as $resident) {
              ?>
              
              <tr>
                <td><?php echo $resident->no_identitas ?></td>
                <td><?php echo $resident->nama ?></td>
                <td><?php echo $resident->alamat ?></td>
                <td>
                  <button class="btn btn-icon btn-info btn-sm" id="select-saksi"
                    data-id="<?php echo $resident->id ?>"
                    data-name="<?php echo $resident->nama ?>"  
                    data-address="<?php echo $resident->alamat ?>"  
                  >
                    <i class="fa fa-check"></i> Pilih
                  </button>
                </td>
              </tr>              
              
              <?php
                }
              ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Modal Cari Nama Korban -->

<?php 
require_once APPROOT . '/views/includes/footer.php';
?>

