<?php
require APPROOT . '/views/includes/head.php';
?>

<section class="section">
  <div class="container mt-5">
    <div class="row">
      <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
        <!-- <div class="login-brand">
          <img src="../assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
        </div> -->

        <div class="card card-primary">
          <div class="card-header">
            <h4>Register</h4>
          </div>

          <div class="card-body">
            <form action="<?php echo URLROOT; ?>/users/register" method="POST" novalidate="">
              <div class="row">
                <div class="form-group col-6">
                  <label for="username">Username</label>
                  <input id="username" type="text" class="form-control <?php echo $data['usernameError'] ?  'is-invalid' :  '' ?>" name="username" autofocus>
                  <div class="invalid-feedback">
                    <?php echo $data['usernameError']; ?>
                  </div>
                </div>
                <div class="form-group col-6">
                  <label for="email">Email</label>
                  <input id="email" type="email" class="form-control <?php echo $data['emailError'] ? 'is-invalid' : '' ?>" name="email">
                  <div class="invalid-feedback">
                    <?php echo $data['emailError']; ?>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="form-group col-6">
                  <label for="password" class="d-block">Password</label>
                  <input id="password" type="password" class="form-control pwstrength <?php echo $data['passwordError'] ? 'is-invalid' : '' ?>" data-indicator="pwindicator" name="password">
                  <div id="pwindicator" class="pwindicator">
                    <div class="bar"></div>
                    <div class="label"></div>
                  </div>
                  <div class="invalid-feedback">
                    <?php echo $data['passwordError']; ?>
                  </div>
                </div>
                <div class="form-group col-6">
                  <label for="password2" class="d-block">Password Confirmation</label>
                  <input id="password2" type="password" class="form-control <?php echo $data['confirmPasswordError'] ? 'is-invalid' : '' ?>" name="confirmPassword">
                  <div class="invalid-feedback">
                    <?php echo $data['confirmPasswordError']; ?>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="agree" class="custom-control-input" id="agree">
                  <label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
                </div>
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                  Register
                </button>
              </div>
            </form>
          </div>
        </div>
        <div class="simple-footer">
          Copyright &copy; Stisla 2018
        </div>
      </div>
    </div>
  </div>
</section>

<?php
require APPROOT . '/views/includes/footer.php';
?>