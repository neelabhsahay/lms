    <nav id="sidebar">
        <div class="sidebar-header">
            <div class="d-flex flex-column align-items-center text-center p-1 py-1 border-bottom">
            <img class="rounded-circle " src="http://localhost/lms/web/assets/img/user.jpg" width="60" height="60">
            <span id="viewName" >Hi, Aashvi</span>
            <span class="text-black-50" type="button">My Info </span>
            </div>
        </div>
        <ul class="list-unstyled components">
            <p>MENUS</p>
            <li> <a data-target="#homeSubmenu" href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" role="button" class="dropdown-toggle" aria-controls="homeSubmenu">Admin</a>
                <ul class="collapse list-unstyled" id="homeSubmenu" data-parent="#sidebar">
                    <li> <a href="http://localhost/lms/web/admin/empdashboard.php">Employee</a> </li>
                    <li> <a href="http://localhost/lms/web/admin/leavedashboard.php">Leave</a> </li>
                    <li> <a href="http://localhost/lms/web/admin/leavestatusdasboard.php">Leave Status</a> </li>
                    <li> <a href="http://localhost/lms/web/admin/userdashboard.php">User</a> </li>
                    <li> <a href="http://localhost/lms/web/admin/holidaydashboard.php">Holiday</a> </li>
                </ul>
            </li>
            <li> <a href="#inventorySubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" aria-controls="#inventorySubmenu">Inventory</a>
               <ul class="collapse list-unstyled" id="inventorySubmenu" data-parent="#sidebar">
                    <li> <a href="#">Add</a> </li>
                    <li> <a href="#">History</a> </li>
                    <li> <a href="#">Stocks</a> </li>
                </ul>
            </li>
            <li> <a href="#travelSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" aria-controls="#homeSubmenu">Travel</a> 
               <ul class="collapse list-unstyled" id="travelSubmenu" data-parent="#sidebar">
                    <li> <a href="#">Apply</a> </li>
                    <li> <a href="#">History</a> </li>
                    <li> <a href="#">Approve</a> </li>
                </ul>
            </li>
            <li> <a href="#leaveSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" aria-controls="#leaveSubmenu">Leaves</a>
                <ul class="collapse list-unstyled" id="leaveSubmenu" data-parent="#sidebar">
                    <li> <a href="http://localhost/lms/web/admin/applyleavedashboard.php">Apply</a> </li>
                    <li> <a href="http://localhost/lms/web/admin/mylrqhdashboard.php">History</a> </li>
                    <li> <a href="http://localhost/lms/web/admin/approvedashboard.php">Approve</a> </li>
                </ul>
            </li>
            <li> <a href="#stationarySubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" aria-controls="#stationarySubmenu">Stationary</a> 
               <ul class="collapse list-unstyled" id="stationarySubmenu" data-parent="#sidebar">
                    <li> <a href="#">Apply</a> </li>
                    <li> <a href="#">History</a> </li>
                    <li> <a href="#">Approve</a> </li>
                </ul>
            </li>
        </ul>
    </nav>
    <script>
    $( document ).ready(function() {
           var url = window.location.href; //get current page url
             $("#sidebar ul li ul a").each(function() {
                if (url == (this.href)) {
                    $(this).parent().addClass("active");
                    $(this).parent().parent().addClass("show"); //add active class to matched LIst item
                }
            });
        });
    </script>
