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
  <link rel= "stylesheet" type="text/css", href="https://davidstutz.github.io/bootstrap-multiselect/css/bootstrap-multiselect.css">
 
 <script type= "text/javascript" src= "//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
 <script type= "text/javascript" src= "//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.0/js/bootstrap.min.js"></script>
 <script type= "text/javascript" src= "//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
 <script type= "text/javascript" src= "//cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/1.8/js/bootstrap-switch.min.js"></script>
 <script type= "text/javascript" src= "https://davidstutz.github.io/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>



  <!-- My scripts and css -->
<script type="text/javascript" src="../asserts/js/modalLms.js"></script>
<script type="test/javascript" src="../asserts/js/yearpicker.js"></script>
<script type="text/javascript" src="../asserts/js/cookie.js" > </script>
<script type="text/javascript" src="js/leave.js"></script>
<script type="text/javascript" src="js/employee.js"></script>
<script type="text/javascript" src="js/user.js"></script>
<script type="text/javascript" src="js/leaveStatus.js"></script>

<link rel="stylesheet" type="text/css" href="../asserts/css/page.css" />
<link rel="stylesheet" type="text/css" href="../asserts/css/yearpicker.css" />

 <!-- Material Design Iconic Font CSS -->
  <link rel="stylesheet" href="../asserts/css/material-design-iconic-font.min.css">
</head>
<body>
    <div class="card_body">
        <?php
            include "../asserts/header.php";
        ?>
        <div class="container-fluid">
            <div class="row">
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 my-3">
                  <div class="card_dashboard-list">
                        <div class="row">
                          <div class="col-12 col-md-6 col-lg-4 col-xl-4 mb-4">
                            <div class="card_dashboard">
                            <div class="blue" >
                              <div class="title">Employees</div>
                                <i class="zmdi zmdi-upload" id="insertEmpBtn" role="button" onclick="displayModal('insertEmpModal')"></i>
                                <div class="value" role="button" onclick="loadListEmp()">213</div>
                                <div class="stat"><b>13</b> Provision</div>
                              
                            </div>
                            </div>
                          </div>
                          <div class="col-12 col-md-6 col-lg-4 col-xl-4 mb-4">
                            <div class="card_dashboard" >
                            <div class="green" >
                              <div class="title">Leaves</div>
                              <i class="zmdi zmdi-upload" role="button" onclick="displayModal('insertLeaveModal')"></i>
                              <div class="value" role="button" onclick="loadListLeave()">2 </div>
                              <div class="stat"><b>2</b> Leaves</div>

                            </div>
                            </div>
                          </div>
                          <div class="col-12 col-md-6 col-lg-4 col-xl-4 mb-4">
                            <div class="card_dashboard" >
                            <div class="orange" >
                              <div class="title">Users</div>
                              <i class="zmdi zmdi-upload" id="insertUserBtn" role="button" onclick="displayModal('insertUserModal')"></i>
                              <div class="value" role="button" onclick="loadListUsr()">2</div>
                              <div class="stat"><b>2</b> Users</div>
                              
                            </div>
                            </div>
                          </div>
                          <div class="col-12 col-md-6 col-lg-4 col-xl-4 mb-4">
                            <div class="card_dashboard">
                            <div class="red" >
                              <div class="title">Leaves Status</div>
                              <i class="zmdi zmdi-upload" id="insertLeaveStatusBtn" role="button" onclick="displayModal('insertLeaveStatusModal')"></i>
                              <div class="value" role="button" onclick="loadListLeaveStatus()" >2</div>
                              <div class="stat"><b>2</b> Leaves</div>
                              
                            </div>
                            </div>
                          </div>
                      </div>
                    </div>

                </main>
            </div>
        </div>
    </div>
  <?php
      include "../asserts/footer.php";
      include "insertEmp.php";
      include "insertLeave.php";
      include "updateLeave.php";
      include "updateEmp.php";
      include "insertLeaveStatus.php";
      include "insertUser.php";
      include "listLeave.php";
      include "listEmp.php";
      include "listUser.php";
      include "listLeaveStatus.php";
 ?>
</body>

</html>