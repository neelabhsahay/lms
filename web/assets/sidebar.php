    <nav id="sidebar">
        <div class="sidebar-header">
            <div class="d-flex flex-column align-items-center text-center p-1 py-1 border-bottom">
               <div id='ProfileDiv' class="pic-holder">
                  <img id="profilePic" class="pic rounded-circle" src="#">
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
               <span id="viewName" >Hi, Aashvi</span>
               <span class="text-black-50" type="button" onclick="showMyInfoDetail()">My Info </span>
            </div>
        </div>
        <ul class="list-unstyled components">
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

            // Load image
            loadProfileImage();
        });
    $(document).on("change", ".uploadProfileInput", function () {
         var triggerInput = this;
         var currentImg = $(this).closest(".pic-holder").find(".pic").attr("src");
         var holder = $(this).closest(".pic-holder");
         var files = !!this.files ? this.files : [];
         if (!files.length || !window.FileReader) {
           return;
         }
         if (/^image/.test(files[0].type)) {
           // only image file
           var reader = new FileReader(); // instance of the FileReader
           reader.readAsDataURL(files[0]); // read the local file

           reader.onloadend = function () {
             $(holder).addClass("uploadInProgress");
             $(holder).find(".pic").attr("src", this.result);
             $(holder).append(
               '<div class="upload-loader"><div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div></div>'
             );

             // Dummy timeout; call API or AJAX below
             setTimeout(() => {
               $(holder).removeClass("uploadInProgress");
               $(holder).find(".upload-loader").remove();
               // If upload successful
             }, 1500);
           };
         }
});

    </script>
