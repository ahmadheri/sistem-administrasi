<?php 
require APPROOT . '/views/includes/head.php';

if (!isLoggedIn()) {
  header('location: ' . URLROOT . '/users/login');
  exit();
}

$page = 'residents';

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
            <h1>Edit Penduduk</h1>
          </div>
          <?php
          if (isset($_SESSION['status'])) :
          ?>
            <div class="alert alert-success" role="alert">
              <?php
              echo $_SESSION['status'];
              // successStatus("Create Success");
              unset($_SESSION['status']);
              ?>
            </div>
          <?php
          endif;

          // print_r($_SESSION);
          // phpinfo();
          ?>

          <div class="row">
            <!-- Form create user -->
            <div class="col-12 col-md-6 col-lg-6">
              <form action="<?php echo URLROOT ?>/residents/update/<?php echo $data['resident']->id ?>" method="POST">
                <div class="card">
                  <div class="card-header">
                    <h4>Edit Resident</h4>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                      <label>Nomor Identitas</label>
                      <input type="text" class="form-control <?php echo $data['nomorIdentitasError'] ?  'is-invalid' :  '' ?>" 
                      name="no_identitas" value="<?php echo $data['resident']->no_identitas ?>" autofocus>
                      <div class="invalid-feedback">
                        <?php echo $data['nomorIdentitasError']; ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Nama Penduduk</label>
                      <input type="text" class="form-control <?php echo $data['namaPendudukError'] ?  'is-invalid' :  '' ?>" 
                      name="nama" value="<?php echo $data['resident']->nama ?>">
                      <div class="invalid-feedback">
                        <?php echo $data['namaPendudukError']; ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Tempat Lahir</label>
                      <input type="text" class="form-control <?php echo $data['tempatLahirError'] ?  'is-invalid' :  '' ?>" 
                      name="tempat_lahir" value="<?php echo $data['resident']->tempat_lahir ?>">
                      <div class="invalid-feedback">
                        <?php echo $data['tempatLahirError']; ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Tanggal Lahir</label>
                      <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input <?php echo $data['tanggalLahirError'] ?  'is-invalid' :  '' ?>" 
                        data-target="#datetimepicker1" name="tanggal_lahir" value="<?php echo date('m/d/Y h:i A', strtotime($data['resident']->tanggal_lahir)) ?>" />
                        <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                        <div class="invalid-feedback">
                          <?php echo $data['tanggalLahirError']; ?>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="d-block">Jenis Kelamin</label>
                      <div class="form-check">
                        <input <?php echo $data['resident']->jenis_kelamin == 'Laki-laki' ? 'checked' : '' ?> class="form-check-input <?php echo $data['jenisKelaminError'] ?  'is-invalid' :  '' ?>" type="radio" 
                        id="laki-laki" name="jenis_kelamin[]" value="Laki-laki">
                        <label class="form-check-label" for="laki-laki">
                          Laki-laki
                        </label>
                      </div>
                      <div class="form-check">
                        <input <?php echo $data['resident']->jenis_kelamin == 'Perempuan' ? 'checked' : '' ?> class="form-check-input <?php echo $data['jenisKelaminError'] ?  'is-invalid' :  '' ?>" type="radio" 
                        id="perempuan" name="jenis_kelamin[]" value="Perempuan">
                        <label class="form-check-label" for="perempuan">
                          Perempuan
                        </label>
                        <!-- invalid feedback for radio button must be inside form check -->
                        <div class="invalid-feedback">
                          <?php echo $data['jenisKelaminError'] ?>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Alamat</label>
                      <textarea class="form-control <?php echo $data['alamatError'] ?  'is-invalid' :  '' ?>" 
                      name="alamat" > <?php echo $data['resident']->alamat ?> </textarea>
                      <div class="invalid-feedback">
                        <?php echo $data['alamatError']; ?>
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


<?php 
require APPROOT . '/views/includes/footer.php';
?>

