  <nav id="sidebar">
        <div class="sidebar-header">
            <div class="d-flex flex-column align-items-center text-center p-1 py-1 border-bottom">
            <div class="pic-holder">
                  <img id="profilePic" class="pic rounded-circle" src="http://localhost/lms/web/assets/img/avatar.png">
                  <label for="newProfilePhoto" class="upload-file-block">
                     <div class="text-center">
                        <div class="mb-2">
                           <img src="http://localhost/lms/web/assets/img/camera.svg">
                        </div>
                        <div class="text-uppercase" style="font-size: 10px;">
                           Update <br /> Profile Photo
                        </div>
                     </div>
                  </label>
                  <Input class="uploadProfileInput" type="file" name="profile_pic" id="newProfilePhoto" accept="image/*" style="display: none;" />
               </div>
               <span id="viewNameInfo" >Hi, Aashvi</span>
               <span class="text-black-50" type="button" onclick="showMyInfoDetail()">My Info </span>
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
                    <li> <a href="#">Holiday</a> </li>
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
            // Load image
            loadProfileImage();
        });
    </script>
