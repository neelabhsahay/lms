<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employee Board</title>
  <link rel="preconnect" type="text/css" href="https://fonts.gstatic.com">


  <!-- My scripts and css -->

 <!-- External Libs -->
 <script type="text/javascript" src='../assets/lib/main.js'></script>
 <script type="text/javascript" src="../assets/extn/jqy/jquery-3.6.0.min.js"></script>
 <script type="text/javascript" src="../assets/extn/4.5.3/js/bootstrap.bundle.min.js"></script>
 <script type="text/javascript" src="../assets/extn/bd/js/bootstrap-dialog.min.js"></script>
 <link rel="stylesheet" type="text/css" href="../assets/extn/4.5.3/css/bootstrap.min.css" >
 <link rel="stylesheet" type="text/css" href="../assets/extn/bd/css/bootstrap-dialog.min.css" >
   
      <!-- My own scripts -->
  <script type="text/javascript" src="../assets/js/modalLms.js"></script>
  <script type="text/javascript" src="../assets/js/libs/moment.js"></script>
  <script type="text/javascript" src="../assets/js/cookie.js" > </script>
  
  <link rel="stylesheet" type="text/css" href="../assets/css/page.css" />
  <link rel='stylesheet' type="text/css" href='../assets/lib/main.css'/>
  
  
  <script type="text/javascript" src="../assets/js/myAjax.js"> </script>
  <script type="text/javascript" src='js/applyLeave.js'></script>
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
         <div class="row no-gutters" style="height:90%;">
            <div class="col-md-2">
            <?php
            include "../assets/empSidebar.php";
            ?>
         </div>
         <div class="col-md-10">
            <?php
            include "listAppliedLeave.php"
            ?>
         </div>
      </div>
   </div>
    <?php
      include "../assets/footer.php";
      include "../admin/viewEmp.php";
      include "applyLeave.php";
      include "viewLeaveRequest.php";
    ?>
<script>
    $(document).ready(function () {
        loadCalendar();
        loadMyLeave();
    });
</script>

</body>

</html>