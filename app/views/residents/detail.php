<?php 
require APPROOT . '/views/includes/head.php';

if (!isLoggedIn()) {
    header('location: '  . URLROOT . '/users/login');
    exit();
}

$page = 'residents';

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
            <h1>Penduduk</h1>
          </div>
          <div class="row">

            <div class="col-md-8">
              <div class="card">
                <div class="card-body">
                  <?php 
                  // var_dump($data['report']->nama_pelapor); 
                  ?>
                  
                  <p><strong>Nama  :</strong> <?php echo $data['resident']->nama ?></p>
                  <p><strong>Tempat Lahir :</strong> <?php echo $data['resident']->tempat_lahir ?></p>
                  <p><strong>Tanggal Lahir :</strong> <?php echo $data['resident']->tanggal_lahir ?></p>
                  <p><strong>Jenis Kelamin:</strong> <?php echo $data['resident']->jenis_kelamin?></p>
                  <p><strong>Alamat :</strong> <?php echo $data['resident']->alamat ?></p>
                  
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

