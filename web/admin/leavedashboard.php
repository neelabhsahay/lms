<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employee Board</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com">

  <link rel= "stylesheet"  type="text/css" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
  <link rel= "stylesheet" type="text/css", href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css">
  <link rel= "stylesheet" type="text/css", href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/1.8/css/bootstrap-switch.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/css/bootstrap-dialog.min.css" rel="stylesheet"/>
 
 <script type= "text/javascript" src= "//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
 <script type= "text/javascript" src= "//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.0/js/bootstrap.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/js/bootstrap-dialog.min.js"></script>
 <script type= "text/javascript" src= "//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
 <script type= "text/javascript" src= "//cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/1.8/js/bootstrap-switch.min.js"></script>


  <!-- My scripts and css -->
<script type="text/javascript" src="../asserts/js/modalLms.js"></script>
<script type="test/javascript" src="../asserts/js/yearpicker.js"></script>
<script type="text/javascript" src="../asserts/js/cookie.js" > </script>
<script type="text/javascript" src="js/leave.js"></script>

<link rel="stylesheet" type="text/css" href="../asserts/css/page.css" />
<link rel="stylesheet" type="text/css" href="../asserts/css/yearpicker.css" />

 <!-- Material Design Iconic Font CSS -->
  <link rel="stylesheet" href="../asserts/css/material-design-iconic-font.min.css">
</head>
<body>
    <div class="card_body">
        <?php
            include "../asserts/header.php";
            include "../asserts/sidebar.php";
        ?>
        <div class="container-fluid">
          <?php
            include "listLeave.php";
          ?>
        </div>
    </div>
    <?php
      include "../asserts/footer.php";
      include "insertLeave.php";
      include "updateLeave.php";
    ?>
<script>
    $(document).ready(function () {
        loadListLeave();
    });
</script>
</body>

</html>