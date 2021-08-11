<div class="p-5 bg-white rounded shadow mb-5" style="height: 100%;">
    <!-- Lined tabs-->
    <ul id="settingTab" role="tablist" class="nav nav-tabs nav-pills with-arrow lined flex-column flex-sm-row text-center">
      <li class="nav-item flex-sm-fill ">
        <a id="home2-tab" data-toggle="tab" href="#password" role="tab" aria-controls="home2" aria-selected="true" class="nav-link  mr-sm-3 rounded-0 active">Password</a>
      </li>
      <li class="nav-item flex-sm-fill">
        <a id="profile2-tab" data-toggle="tab" href="#profile2" role="tab" aria-controls="profile2" aria-selected="false" class="nav-link mr-sm-3 rounded-0">Profile</a>
      </li>
      <li class="nav-item flex-sm-fill">
        <a id="contact2-tab" data-toggle="tab" href="#contact2" role="tab" aria-controls="contact2" aria-selected="false" class="nav-link  mr-sm-3 rounded-0">Contact</a>
      </li>
    </ul>
    <div id="myTab2Content" class="tab-content">
      <div id="password" role="tabpanel" aria-labelledby="home-tab" class="tab-pane fade px-4 py-5 show active">
          <div class="container">
              <div class="row">
                <div class="col-sm-4">
                </div>
                 <div class="col-sm-4">
                    <label>Current Password</label>
                    <div class="form-group pass_show">
                        <input type="password" value="" class="form-control" placeholder="Current Password">
                    </div>
                    <label>New Password</label>
                    <div class="form-group pass_show">
                        <input type="password" value="" class="form-control" placeholder="New Password">
                    </div>
                    <label>Confirm Password</label>
                    <div class="form-group pass_show">
                        <input type="password" value="" class="form-control" placeholder="Confirm Password">
                    </div>
                    <button type="submit" class="btn btn-primary profile-button" >RESET PASSWORD</button>
                  </div>
                  <div class="col-sm-4">
                  </div>
              </div>
          </div>
        </div>
      <div id="profile2" role="tabpanel" aria-labelledby="profile-tab" class="tab-pane fade px-4 py-5">

      </div>
      <div id="contact2" role="tabpanel" aria-labelledby="contact-tab" class="tab-pane fade px-4 py-5">
      </div>
    </div>
    <!-- End lined tabs -->
  </div>

  <script type="text/javascript">
    $(document).ready(function(){
        $('.pass_show').append('<span class="ptxt">Show</span>');
    });
    $(document).on('click','.pass_show .ptxt', function(){
        $(this).text($(this).text() == "Show" ? "Hide" : "Show");
        $(this).prev().attr('type', function(index, attr){return attr == 'password' ? 'text' : 'password'; });
    });
  </script>
