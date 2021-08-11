  <nav id="sidebar">
        <div class="sidebar-header">
            <div class="d-flex flex-column align-items-center text-center p-1 py-1 border-bottom">
            <div class="pic-holder">
                  <img id="profilePic" class="pic rounded-circle" src="http://localhost/lms/web/assets/img/avatar.png">
                  <label for="newProfilePhoto" class="upload-file-block">
                     <div class="text-center">
                        <div class="mb-2">
                           <img src="http://localhost/lms/web/assets/img/camera.svg" height="25px" width="25px">
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
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
               <div class="modal-content">
                     <div class="modal-header">
                     <h5 class="modal-title">Crop Image Before Upload</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">×</span>
                     </button>
                     </div>
                     <div class="modal-body">
                     <div class="img-container">
                           <div class="row">
                              <div class="col-md-8">
                                 <img src="" id="sample_image" />
                              </div>
                              <div class="col-md-4">
                                 <div class="preview"></div>
                              </div>
                           </div>
                     </div>
                     </div>
                     <div class="modal-footer">
                        <button type="button" id="crop" class="btn btn-primary">Crop</button>
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                     </div>
               </div>
            </div>
         </div>
   <script type="text/javascript" src="../assets/extn/crop/cropper.js" ></script>
   <link rel="stylesheet" type="text/css" href="../assets/extn/crop/cropper.min.css" >
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

            // Section for update profile picture
            var $modal = $('#modal');
            var image = document.getElementById('sample_image');
            var cropper;
            $('#newProfilePhoto').change(function(event){
                var files = event.target.files;
                var done = function(url){
                    image.src = url;
                    $modal.modal('show');
                };

                if(files && files.length > 0)
                {
                    reader = new FileReader();
                    reader.onload = function(event)
                    {
                        done(reader.result);
                    };
                    reader.readAsDataURL(files[0]);
                }
            });

            $modal.on('shown.bs.modal', function() {
                cropper = new Cropper(image, {
                    aspectRatio: 1,
                    viewMode: 3,
                    preview:'.preview'
                });
            }).on('hidden.bs.modal', function(){
                cropper.destroy();
                cropper = null;
            });

            $('#crop').click(function(){
                canvas = cropper.getCroppedCanvas({
                width:100,
                height:100
            });

            canvas.toBlob(function(blob){
                url = URL.createObjectURL(blob);
                    var reader = new FileReader();
                    reader.readAsDataURL(blob);
                    reader.onloadend = function(){
                    var base64data = reader.result;
                     // PUT AJAX FUNCTION FOR LOAD IMAGE
                     uploadProfileImageAJAX(blob, closeImageCropModal)
                 };
              });
            });
        });

    </script>
