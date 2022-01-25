<?php
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
            <h1>Daftar User</h1>
          </div>
          <div class="row">

            <!-- Form edit user -->
            <div class="col-12 col-md-6 col-lg-6">
              <form action="<?php echo URLROOT ?>/users/update/<?php echo $data['user']->id ?>" method="POST">
                <div class="card">
                  <div class="card-header">
                    <h4>Create User</h4>
                  </div>

                  <div class="card-body">
                    <div class="form-group">
                      <label>Username</label>
                      <input type="text" class="form-control" name="username" value="<?php echo $data['user']->username ?>" autofocus>
                      <div class="invalid-feedback">
                        <?php echo $data['usernameError']; ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" class="form-control " name="email" value="<?php echo $data['user']->email ?>">
                      <div class="invalid-feedback">
                        <?php echo $data['emailError']; ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="d-block">Role</label>
                      <div class="form-check">
                        <input <?php echo $data['user']->role == 'Admin' ? 'checked' : '' ?> class="form-check-input " 
                        type="radio" id="admin" name="role" value="Admin">
                        <label class="form-check-label" for="admin">
                          Administrator
                        </label>
                      </div>
                      <div class="form-check">
                        <input <?php echo $data['user']->role == 'Operator' ? 'checked' : '' ?> class="form-check-input "
                          type="radio" id="operator" name="role" value="Operator">
                        <label class="form-check-label" for="operator">
                          Operator
                        </label>
                      </div>
                      <div class="invalid-feedback">
                        <?php echo $data['roleError'] ?>
                      </div>
                    </div>

                  </div>
                  <div class="card-footer text-right">
                    <button class="btn btn-primary mr-1" type="submit">Submit</button>
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