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
            <li> <a href="#travelSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Travel</a> 
               <ul class="collapse list-unstyled" id="travelSubmenu" data-parent="#sidebar">
                    <li> <a href="#">Apply</a> </li>
                    <li> <a href="#">History</a> </li>
                    <li> <a href="#">Approve</a> </li>
                </ul>
            </li>
            <li> <a href="#leaveSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Leaves</a>
                <ul class="collapse list-unstyled" id="leaveSubmenu" data-parent="#sidebar">
                    <li> <a href="http://localhost/lms/web/emp/dashboard.php">Apply</a> </li>
                    <li> <a href="http://localhost/lms/web/emp/mylrqhdashboard.php">History</a> </li>
                    <li> <a href="http://localhost/lms/web/emp/approvedashboard.php">Approve</a> </li>
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