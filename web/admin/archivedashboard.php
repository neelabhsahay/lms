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
      <script type="text/javascript" src="../assets/extn/crop/cropper.js"></script>
      <link rel="stylesheet" type="text/css" href="../assets/extn/4.5.3/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="../assets/extn/bd/css/bootstrap-dialog.min.css">
      <link rel="stylesheet" type="text/css" href="../assets/extn/crop/cropper.min.css">
      <link rel="stylesheet" href="../assets/css/material-design-iconic-font.min.css">
      <link rel="stylesheet" href="../assets/lib/spage/pagination.css">
      <!-- My own scripts -->
      <script type="text/javascript" src="../assets/js/modalLms.js"></script>
      <script type="text/javascript" src="../assets/js/cookie.js"> </script>
      <link rel="stylesheet" type="text/css" href="../assets/css/page.css" />
      <link rel='stylesheet' type="text/css" href='../assets/lib/main.css' />
      <script type="text/javascript" src="../assets/js/myAjax.js"> </script>
      <script type="text/javascript" src='js/employee.js'></script>
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
            <div class="sidebar-row col-md-2 ">
               <?php
            include "../assets/sidebar.php";
            ?>
            </div>
            <div class="col-md-10">
               <div class="container-fuild" style="height:100%">
                  <div class="list-form-content">
                     <div class="legent-header border-bottom">
                        <center>
                           <h4>Employees</h4>
                        </center>
                     </div><br>
                     <div class="row mb-4">
                        <div class="col-md-3 selectContainer">
                           <div class="input-group">
                              <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                              <input name="searchEmp" onkeyup="searchEmployeeInList(this.value)" placeholder="Search for names.." class="form-control" type="text">
                           </div>
                        </div>
                     </div>
                     <div class="row mb-4" style="position:relative;">
                        <div class="col-md-12 selectContainer">
                           <div class="input-group">
                              <table id="listTable" class="table table-bordered table-condensed table-striped table-sm">
                                 <thead class="thead-dark-hdr">
                                    <tr>
                                       <th>Emp Id</th>
                                       <th>Name</th>
                                       <th>Location</th>
                                       <th>Manager</th>
                                       <th>Contact</th>
                                       <th>E-Mail</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                              </table>
                           </div>
                        </div>
                        <!--        Start Pagination -->
                        <div class="col-md-12 pagination-container" id="pagerDIV">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?php
      include "../assets/footer.php";
      include "updateEmp.php";
      include "viewEmp.php";
    ?>
      <script>
      $(document).ready(function() {
         loadArchiveListEmp();
      });
      </script>
   </body>

</html>