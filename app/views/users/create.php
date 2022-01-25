<?php
require APPROOT . '/views/includes/head.php';

if (!isLoggedIn()) {
  header('location: '  . URLROOT . '/users/login');
  exit();
}

$page = 'users';

$data['role'] = '';

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

            <!-- Form create user -->
            <div class="col-12 col-md-6 col-lg-6">
              <form action="<?php echo URLROOT ?>/users/create" method="POST">
                <div class="card">
                  <div class="card-header">
                    <h4>Create User</h4>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                      <label>Username</label>
                      <input type="text" class="form-control <?php echo $data['usernameError'] ?  'is-invalid' :  '' ?>" 
                      name="username" value="<?= isset($_POST['username']) ? $_POST['username'] : ''; ?>" autofocus>
                      <div class="invalid-feedback">
                        <?php echo $data['usernameError']; ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" class="form-control <?php echo $data['emailError'] ?  'is-invalid' :  '' ?>" 
                      name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                      <div class="invalid-feedback">
                        <?php echo $data['emailError']; ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="d-block">Role</label>
                      <div class="form-check">
                        <input class="form-check-input <?php echo $data['roleError'] ? 'is-invalid' :  '' ?>" type="radio" 
                        id="admin" name="role" value="Admin" <?= (isset($_POST['role']) && $_POST['role'] == 'Admin' ) ? 'checked="checked"' : ''; ?>  >
                        <label class="form-check-label" for="admin">
                          Admin
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input <?php echo $data['roleError'] ? 'is-invalid' :  '' ?>" type="radio" 
                        id="operator" name="role" value="Operator" <?= (isset($_POST['role']) && $_POST['role'] == 'Operator' ) ? 'checked="checked"' : ''; ?> >
                        <label class="form-check-label" for="operator">
                          Operator
                        </label>
                        <!-- invalid feedback for radio button must be inside form check -->
                        <div class="invalid-feedback">
                          <?php echo $data['roleError'] ?>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" class="form-control <?php echo $data['passwordError'] ?  'is-invalid' :  '' ?>" 
                      name="password">
                      <div class="invalid-feedback">
                        <?php echo $data['passwordError']; ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Confirm Password</label>
                      <input type="password" class="form-control <?php echo $data['confirmPasswordError'] ?  'is-invalid' :  '' ?>" 
                      name="confirmPassword">
                      <div class="invalid-feedback">
                        <?php echo $data['confirmPasswordError']; ?>
                      </div>
                    </div>

                  </div>
                  <div class="card-footer text-right">
                    <button class="btn btn-primary mr-1" id="create-user" type="submit">Submit</button>
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