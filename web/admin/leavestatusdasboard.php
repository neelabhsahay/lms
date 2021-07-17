<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employee Board</title>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script type= "text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type= "text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script type= "text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com">

  <link rel= "stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
  <link rel= "stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css">
  <link rel= "stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/css/bootstrap-dialog.min.css"/>
 
 <script type= "text/javascript" src= "https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
 <script type= "text/javascript" src= "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.0/js/bootstrap.min.js"></script>
 <script type= "text/javascript" src= "https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/js/bootstrap-dialog.min.js"></script>
 <script type= "text/javascript" src= "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>


  <!-- My scripts and css -->

<script type="text/javascript" src="../asserts/js/modalLms.js"></script>
<script type="text/javascript" src="../asserts/js/myAjax.js" > </script>
<script type="text/javascript" src="js/leaveStatus.js"></script>
<script src="../asserts/lib/spage/pagination.js"></script>

<link rel="stylesheet" type="text/css" href="../asserts/css/page.css" />
<link rel="stylesheet" type="text/css" href="../asserts/css/yearpicker.css" />


<!-- Material Design Iconic Font CSS -->
   <link rel="stylesheet" href="../asserts/css/material-design-iconic-font.min.css">
  <link rel="stylesheet" href="../asserts/lib/spage/pagination.css">
 
</head>
<body>
    <div class="card_body">
        <?php
            include "../asserts/header.php";
            include "../asserts/sidebar.php";
        ?>
        <div>
          <?php
            include "listLeaveStatus.php";
            
          ?>
        </div>
    </div>
    <?php
      include "../asserts/footer.php";
      include "insertLeaveStatus.php";
      include "updateLeaveStatus.php";
      include "viewEmp.php";
    ?>
<script src= '../asserts/js/libs/jquery.min.js'></script>
<script src= '../asserts/js/libs/core.js'></script>
<script src= "../asserts/js/libs/yearpicker.js"></script>
<script src= "../asserts/js/cookie.js" > </script>
<script>
    $(document).ready(function () {
        $(".yearpicker").yearpicker({
          startYear: new Date().getFullYear() - 50,
          endYear: new Date().getFullYear() + 10,
        });
        loadListLeaveStatus();
    });
</script>
</body>

</html>