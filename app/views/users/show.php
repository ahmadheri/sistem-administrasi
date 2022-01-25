<?php 
// HEADER
require APPROOT . '/views/includes/head.php';

if (!isLoggedIn()) {
  header('location: '  . URLROOT . '/users/login');
  exit();
}

$page = 'users';
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
            <h1>Profil User</h1>
          </div>
          <div class="row">

            <div class="col-md-8">
              <div class="card">
                <div class="card-body">
                  <?php 
                  // var_dump($data['user']->username); 
                  ?>
                  
                  <p><strong>Username :</strong> <?php echo $data['user']->username ?></p>
                  <p><strong>Email :</strong> <?php echo $data['user']->email ?></p>
                  <p><strong>Role :</strong> <?php echo $data['user']->role ?></p>
                  
                  
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
