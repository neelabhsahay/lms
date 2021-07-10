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
  <script src="../js/applyLeave.js"></script>
  <link rel="stylesheet" type="text/css" href="../asserts/css/page.css" /> 
  <!-- Material Design Iconic Font CSS -->
  <link rel="stylesheet" href="../asserts/css/material-design-iconic-font.min.css">
</head>
<body>
    <div class="card_body">
          <?php include "../asserts/header.php"; ?>
           
          <div class="container-fluid">
              <div class="row">
                  <?php include "../asserts/sidebar.php"; ?>
                  <main role="main" class="col-md-9 ml-sm-auto col-lg-10 my-3">
                      <div class="card_dashboard-list">
                        <div class="row">
                          <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                            <div class="card_dashboard">
                            <div class="blue">
                              <div class="title">My Leaves</div>
                              <i class="zmdi zmdi-upload"></i>
                            </div>
                            </div>
                          </div>
                          <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                            <div class="card_dashboard">
                               <div class="green" id="appyLeaveBtn" role="button">
                                <div class="title">Apply Leaves</div>
                                
                                <i class="zmdi zmdi-upload"></i>
                                <?php include "applyLeave.php" ?>
                              </div>
                            </div>
                          </div>
                          <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                            <div class="card_dashboard" >
                              <div class="orange">
                                <div class="title">My Profile</div>
                                <i class="zmdi zmdi-download"></i>
                                <div class="value">$80,990</div>
                                <div class="stat"><b>13</b>% decrease</div>
                              </div>
                            </div>
                          </div>
                          </div>
                        </div>

                      <div class="projects mb-4">
                        <div class="projects-inner">
                          <header class="projects-header">
                            <div class="title">Coming Leave </div>
                            <div class="count">| 32 Leaves</div>
                            <i class="zmdi zmdi-download"></i>
                          </header>
                          <table class="projects-table">
                            <thead>
                              <tr>
                                <th>Project</th>
                                <th>Deadline</th>
                                <th>Leader + Team</th>
                                <th>Budget</th>
                                <th>Status</th>
                                <th class="text-right">Actions</th>
                              </tr>
                            </thead>
                            <tr>
                              <td>
                                <p>New Dashboard</p>
                                <p>Google</p>
                              </td>
                              <td>
                                <p>17th Oct, 15</p>
                                <p class="text-danger">Overdue</p>
                              </td>
                              <td class="member">
                                <figure></figure>
                                <div class="member-info">
                                  <p>Myrtle Erickson</p>
                                  <p>UK Design Team</p>
                                </div>
                              </td>
                              <td>
                                <p>$4,670</p>
                                <p>Paid</p>
                              </td>
                              <td class="status">
                                <span class="status-text status-orange">In progress</span>
                              </td>
                              <td>
                                <form class="form" action="#" method="POST">
                                <select class="action-box">
                                  <option>Actions</option>
                                  <option>Start project</option>
                                  <option>Send for QA</option>
                                  <option>Send invoice</option>
                                </select>
                                </form>
                              </td>
                            </tr>
                            <tr class="danger-item">
                              <td>
                                <p>New Dashboard</p>
                                <p>Google</p>
                              </td>
                              <td>
                                <p>17th Oct, 15</p>
                                <p class="text-danger">Overdue</p>
                              </td>
                              <td class="member">
                                <figure></figure>
                                <div class="member-info">
                                  <p>Myrtle Erickson</p>
                                  <p>UK Design Team</p>
                                </div>
                              </td>
                              <td>
                                <p>$4,670</p>
                                <p>Paid</p>
                              </td>
                              <td class="status">
                                <span class="status-text status-red">Blocked</span>
                              </td>
                              <td>
                                <form class="form" action="#" method="POST">
                                  <select class="action-box">
                                    <option>Actions</option>
                                    <option>Start project</option>
                                    <option>Send for QA</option>
                                    <option>Send invoice</option>
                                  </select>
                                </form>
                              </td>
                            </tr>          
                          </table>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
    <?php
        include "../asserts/footer.php";
    ?>
</body>
</html>