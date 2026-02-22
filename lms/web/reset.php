<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Leave Mangement System</title>

<link rel= "stylesheet"  type="text/css" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
<link rel= "stylesheet" type="text/css", href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css">
<link rel= "stylesheet" type="text/css", href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/1.8/css/bootstrap-switch.css"> 
<link rel= "stylesheet" type="text/css", href="https://davidstutz.github.io/bootstrap-multiselect/css/bootstrap-multiselect.css">
 
<!-- My scripts and css -->
<script src="login.js" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="asserts/css/page.css" />
</head>
<body>
  <div class="card_login">
      <form action=" " method="post" class="well form-horizontal" id="reset_form" onsubmit="return validateLoginForm()">
      <fieldset>
        <!-- Form Name -->
        <legend><center><h2><b>Reset Password</b></h2></center></legend><br>
          <div class="form-group">
            <div class="col-md-12 inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input name="username" placeholder="Username"  class="form-control"  type="text">
                </div>
            </div>
          </div>
          <div class="form-group"> 
            <div class="col-md-12 inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                    <input name="password" placeholder="Password" class="form-control"  type="password">
                </div>
            </div>
          </div>
          <div class="form-group"> 
            <div class="col-md-12 inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                    <input name="repassword" placeholder="Re-password" class="form-control"  type="password">
                </div>
            </div>
          </div>
          <div class="form-group">
              <div class="group">
                  <div class="hr"></div>
                  <label class="col-md-12 control-label"></label>
                  <div class="col-md-12"><br>
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button type="submit" class="btn btn-warning" >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspRESET <span         class="glyphicon glyphicon-send"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</button>
                 </div>
               </div>
          </div>
    </fieldset>
    </form>
  </div>
  <?php
      include "asserts/footer.php";
  ?>
  </body>
</html>