<?php
require APPROOT . '/views/includes/head.php';

if (!isAdmin()) {
  header('location: ' . URLROOT . '/home');
}

if (!isLoggedIn()) {
  header('location: ' . URLROOT . '/users/login');
  exit();
} 
$page = 'users';

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
            <h1>Daftar User</h1>
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
                <a href="<?php echo URLROOT ?>/users/create"> 
                  <button class="btn btn-primary mb-2"> <i class="fas fa-user"></i>
                  <span>Tambah User</span> </button></a>
              </div>
            </div>
          </div>
              
          <!-- Table showing data -->
          <div class="row" >
            <div class="card card-table" style="width: 100%;">
            <table id="table-data" class="table table-bordered">
              <thead>
                <tr>
                  <th><b>Username</b></th>
                  <th><b>Email</b></th>
                  <th><b>Role</b></th>
                  <th><b>Action</b></th>
                </tr>
              </thead>
              <tbody>
                
                  <?php

                    foreach ( $data['users'] as $user) {
                      ?>
                    <tr>
                      <td><?php echo $user->username; ?></td>
                      <td><?php echo $user->email; ?></td>
                      <td><?php echo $user->role; ?></td>
                      <td>
                        <a href="<?php echo URLROOT . '/users/show/' . $user->id; ?>" 
                        class="btn btn-icon btn-light btn-sm">Detail</a>
                        <a href="<?php echo URLROOT . '/users/edit/' . $user->id; ?>" 
                        class="btn btn-icon btn-info btn-sm">Edit</a>
                        <form 
                          action="<?php echo URLROOT . '/users/delete/' . $user->id ?>" 
                          method="POST" 
                          onsubmit="return confirm('Hapus user ini permanent?')"
                          style="display:inline;"> 
                          <input type="submit" name="delete" value="Delete" class="btn btn-danger btn-sm ">
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