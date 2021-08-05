<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employee Board</title>
  <script type="text/javascript" src='assets/lib/main.js'></script>
  <script type="text/javascript" src="assets/extn/jqy/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" src="assets/extn/4.5.3/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="assets/extn/bd/js/bootstrap-dialog.min.js"></script>
  <link rel="stylesheet" type="text/css" href="assets/extn/4.5.3/css/bootstrap.min.css" >
  <link rel="stylesheet" type="text/css" href="assets/extn/bd/css/bootstrap-dialog.min.css" >


<!-- My scripts and css -->
  <script type="text/javascript" src="assets/js/cookie.js" > </script>
  <script type="text/javascript" src="assets/js/myAjax.js" > </script>
   <script type="text/javascript" src="assets/js/modalLms.js" > </script>
  <script type="text/javascript" src="login.js"> </script>
  <link rel="stylesheet" type="text/css" href="assets/css/page.css" />
</head>
<body>
  <div class="card_login">
      <form method="post" class="well form-horizontal" id="login_form" onsubmit="return loginUser()">
        <!-- Form Name -->
        <legend><center><h3><b>Login</b></h3></center></legend><br>
          <div class="row mb-4">
            <div class="col-md-12 "><br>
              <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input id="username" placeholder="Username"  class="form-control"  type="text">
                </div>
            </div>
          </div>
          <div class="row mb-4">
            <div class="col-md-12 "><br>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                    <input id="password" placeholder="Password" class="form-control"  type="password">
                </div>
            </div>
          </div>
          <div class="row mb-4 border-bottom">
              <div class="col-md-12 "><br>
                  <input id="check" type="checkbox" class="check" checked>
                  <label for="check"><span class="icon"></span> Keep me Signed in</label>
              </div>
          </div>
          <div class="row mb-4">
                  <div class="hr"></div>
                  <label class="col-md-12 "></label>
                  <div class="col-md-12"><br>
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button type="submit" class="btn btn-warning" id="loginBtn">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspSIGN IN <span class="glyphicon glyphicon-send"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</button>
                 </div>
                 <div class="col-md-12"><br>
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href="#forgot">Forgot Password?</a>
                 </div>
          </div>

    </form>
  </div>
  <?php
      include "asserts/footer.php";
  ?>

  </body>
</html>
