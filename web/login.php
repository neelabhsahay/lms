<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employee Board</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel= "stylesheet"  type="text/css" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
  <link rel= "stylesheet" type="text/css", href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/1.8/css/bootstrap-switch.css"> 
 


<!-- My scripts and css -->
  <script type="text/javascript" src="asserts/js/cookie.js" > </script>
  <script type="text/javascript" src="login.js"> </script>
  <link rel="stylesheet" type="text/css" href="asserts/css/page.css" />
</head>
<body>
  <div class="card_login">
      <form method="post" class="well form-horizontal" id="login_form" onsubmit="return loginUser()">
        <!-- Form Name -->
        <legend><center><h2><b>Login</b></h2></center></legend><br>
          <div class="form-group">
            <div class="col-md-12 inputGroupContainer">
              <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input id="username" placeholder="Username"  class="form-control"  type="text">
                </div>
            </div>
          </div>
          <div class="form-group"> 
            <div class="col-md-12 inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                    <input id="password" placeholder="Password" class="form-control"  type="password">
                </div>
            </div>
          </div>
          <div class="form-group"> 
              <div class="col-md-12 inputGroupContainer">
                  <input id="check" type="checkbox" class="check" checked>
                  <label for="check"><span class="icon"></span> Keep me Signed in</label>
              </div>
          </div>
          <div class="form-group">
              <div class="group">
                  <div class="hr"></div>
                  <label class="col-md-12 inputGroupContainer"></label>
                  <div class="col-md-12"><br>
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button type="submit" class="btn btn-warning" id="loginBtn">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspSIGN IN <span class="glyphicon glyphicon-send"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</button>
                 </div>
               </div>
          </div>
          <div class="form-group">
              <div class="form-group">
                  <div class="col-md-12 foot-lnk">
                      <a href="#forgot">Forgot Password?</a>
                  </div>
              </div>
          </div>
    </form>
  </div>
  <?php
      include "asserts/footer.php";
  ?>

  </body>
</html>