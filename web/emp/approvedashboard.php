<!DOCTYPE html>
<html lang="en">

   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Employee Board</title>
      <link rel="preconnect" type="text/css" href="https://fonts.gstatic.com">


      <!-- My and local scripts and css -->
      <!-- External Libs -->
      <script type="text/javascript" src="../assets/extn/jqy/jquery-3.6.0.min.js"></script>
      <script type="text/javascript" src="../assets/extn/4.5.3/js/bootstrap.bundle.min.js"></script>
      <script type="text/javascript" src="../assets/extn/bd/js/bootstrap-dialog.min.js"></script>
      <script type="text/javascript" src="../assets/lib/spage/pagination.js"></script>

      <link rel="stylesheet" type="text/css" href="../assets/extn/4.5.3/css/bootstrap.min.css" >
      <link rel="stylesheet" type="text/css" href="../assets/extn/bd/css/bootstrap-dialog.min.css" >
      <link rel="stylesheet" href="../assets/lib/spage/pagination.css">
      

      <!-- My own scripts -->


      <link rel="stylesheet" type="text/css" href="../assets/css/page.css" />

      <script type="text/javascript" src="../assets/js/modalLms.js"></script>
      <script type="text/javascript" src="../assets/js/cookie.js"> </script>
      <script type="text/javascript" src="../assets/js/myAjax.js"> </script>
      <script type="text/javascript" src='js/viewLeaveRequest.js'></script>
      <script type="text/javascript" src='js/leaveRequestDetails.js'></script>

   </head>

   <body>
      <div class="card_body">
         <div class="row">
         <div class="col-md-12">
            <?php
            include "../assets/header.php";
            ?>
         </div>
         </div>
         <div class="row">
            <div class="col-md-1">
            <?php
            include "../assets/empSidebar.php";
            ?>
         </div>
         <div class="col-md-12">
            <?php
            include "myleaveApproveList.php"
            ?>
         </div>
      </div>
   </div>
      <?php
      
      include "../admin/viewEmp.php";
      include "viewLeaveRequest.php";
      include "../assets/footer.php";
    ?>
      <script>
      $(document).ready(function() {
         myLeaveRequestForApprove();
      });
      </script>
   </body>
</html>