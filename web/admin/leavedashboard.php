<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employee Board</title>
  
  <!-- My scripts and css -->

 <!-- External Libs -->
 <script type="text/javascript" src="../assets/extn/jqy/jquery-3.6.0.min.js"></script>
 <script type="text/javascript" src="../assets/extn/4.5.3/js/bootstrap.bundle.min.js"></script>
 <script type="text/javascript" src="../assets/extn/bd/js/bootstrap-dialog.min.js"></script>
 <script type="text/javascript" src="../assets/lib/spage/pagination.js"></script>

 <link rel="stylesheet" type="text/css" href="../assets/extn/4.5.3/css/bootstrap.min.css" >
 <link rel="stylesheet" type="text/css" href="../assets/extn/bd/css/bootstrap-dialog.min.css" >
 <link rel="stylesheet" href="../assets/css/material-design-iconic-font.min.css">
 <link rel="stylesheet" href="../assets/lib/spage/pagination.css">
   
      <!-- My own scripts -->
  <script type="text/javascript" src="../assets/js/modalLms.js"></script>
  <script type="text/javascript" src="../assets/js/cookie.js" > </script>
  
  <link rel="stylesheet" type="text/css" href="../assets/css/page.css" />
  <link rel='stylesheet' type="text/css" href='../assets/lib/main.css'/>
  
  
  <script type="text/javascript" src="../assets/js/myAjax.js"> </script>
  <script type="text/javascript" src='js/leave.js'></script>
</head>
<body>
    <div class="card_body">
        <?php
            include "../assets/header.php";
            include "../assets/sidebar.php";
        ?>
        <div class="container-fluid">
          <?php
            include "listLeave.php";
          ?>
        </div>
    </div>
    <?php
      include "../assets/footer.php";
      include "insertLeave.php";
      include "updateLeave.php";
      include "viewEmp.php";
    ?>
<script>
    $(document).ready(function () {
        loadListLeave();
    });
</script>
</body>

</html>