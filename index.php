
<?php include_once("header.php")?>
<link rel="stylesheet" href="asset\css_custom\login.css">
<link rel="stylesheet" href="asset\boostrap_css\sweetalert.css">

<!-- Login section -->

<div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Sign In</h5>
            <div class="form-signin">
              <div class="form-label-group">
                <input type="text" id="inputEmail" class="form-control" placeholder="Email address" autofocus>
                <label for="inputEmail">User Name</label>
              </div>

              <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control" placeholder="Password">
                <label for="inputPassword">Password</label>
              </div>

              <button class="btn btn-lg btn-primary btn-block text-uppercase" id="login_btn">Sign in</button>
              <hr class="my-4">
             
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  

<?php include_once("footer.php")?>

<!-- Functions -->
<script src="functions\login\login.js"></script>
<!-- End of the functions -->

</body>
</html>