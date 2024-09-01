<?php require('home/session.php');?>
<?php if(logged_in()){ error_reporting(0); ?>
          <script type="text/javascript">
            window.location = "home/index.php";
          </script>
<?php } ?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body style="background-image: url('images/background.jpg');height: 100%;background-position: center; background-repeat: no-repeat; background-size: cover;">

<center>
		<div class="card shadow mb-4 col-xs-12 col-md-4 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Welcome to BakeryPro SCM!</h4>
            </div>
            &nbsp;
            <form class="user" role="form" action="processlogin.php" method="post">
                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <label for="username">Username / Email : </label>
                      </div>

                      <div class="col-sm-9">
                        <input class="form-control" placeholder="Username / Email" value="<?php if(isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } ?>" name="user" type="text" autofocus required>
                      </div>
                    </div>
                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <label for="password">Password : </label>
                      </div>
                      <div class="col-sm-9">
                        <input class="form-control" placeholder="Password" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>" name="password" type="password" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
			                <input type="checkbox" name="remembercredentials" style="height:20px;width:20px;padding-top:100px;"> Remember Me?
                      </div>
                    </div>
                    <button class="btn btn-primary btn-user btn-block" type="submit" name="btnlogin">Login</button>
                    &nbsp;
            </form>
                    <a href="index.php?o=signup&auth=invalid">Signup Now</a>

                    <hr>

		            <form action="index.php" method="post">
                   <div class="text-center">
                    <button class="btn btn-info btn-user btn-block" type="submit" name="btnforgot">Forgot Password?</button>
  		              <input type="hidden" name="o" value="forgot.password">
                  </div> 
		            </form>
                &nbsp;
    </div>
  </center>

</body>
</html>