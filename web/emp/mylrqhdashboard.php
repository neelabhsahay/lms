<!DOCTYPE html>
<html lang="en">

   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Employee Board</title>
      <link rel="preconnect" type="text/css" href="https://fonts.gstatic.com">
      <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/css/bootstrap-dialog.min.css">
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.0/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/js/bootstrap-dialog.min.js"></script>
      <!-- My scripts and css -->
      <script type="text/javascript" src="../asserts/js/modalLms.js"></script>
      <script type="text/javascript" src="../asserts/js/cookie.js"> </script>
      <link rel="stylesheet" type="text/css" href="../asserts/css/page.css" />

      <script type="text/javascript" src="../asserts/js/myAjax.js"> </script>
      <script type="text/javascript" src='js/viewLeaveRequest.js'></script>
   </head>

   <body>
      <div class="card_body">
         <?php
            include "../asserts/header.php";
            include "../asserts/empSidebar.php";
        ?>
         <div class="container-fluid">
            <?php
             include "mylvreqList.php"
          ?>
         </div>
      </div>
      <?php
      include "../asserts/footer.php";
      include "applyLeave.php";
      include "../admin/viewEmp.php";
    ?>
      <script>
      $(document).ready(function() {
         myLeaveRequestHistory()
      });
      </script>
   </body>

</html>