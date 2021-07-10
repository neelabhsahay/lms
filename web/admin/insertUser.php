<div id="insertUserModal" class="modal-form">
    <div class="modal-form-content">
        <div class="container">
    <span id="insertLeaveClose" onclick="closeModal('insertUserModal')" class="modal-form-close">&times;</span>
    <form class="well form-horizontal" action=" " method="post"  id="userForm">
        <fieldset>

        <!-- Form Name -->
        <legend><center><h2><b id="userheader">Insert User</b></h2></center></legend><br>

        <!-- Text input-->

         <div class="form-group"> 
            <label class="col-md-2 control-label" >Username</label> 
            <div class="col-md-3 inputGroupContainer">
            <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
          <input id="usrusername" placeholder="Username" class="form-control"  type="text">
            </div>
          </div>
            <label class="col-md-2 control-label">Employee</label>
            <div class="col-md-3 selectContainer">
            <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id="usrempId" placeholder="Employee"  class="form-control"  type="text">
          </div>
          </div>
         
        </div>       
       <div class="form-group"> 
            <label class="col-md-2 control-label" >Password</label> 
            <div class="col-md-3 inputGroupContainer">
            <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
          <input id="usrpassword" placeholder="Password" class="form-control"  type="password">
            </div>
          </div>
            <label class="col-md-2 control-label">Re-Password</label>
            <div class="col-md-3 selectContainer">
            <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id="usrrepassword" placeholder="Re-password"  class="form-control"  type="password">
          </div>
          </div>
         
        </div>  
          <div class="form-group"> 
            <label class="col-md-2 control-label">Account Type</label>
            <div class="col-md-3 selectContainer">
            <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
              <select id="usraccountType" class="form-control"  type="select">
                <option value="EMP">Employee</option>
                <option value="ADM">Admin</option>
                <option value="SUP">Suspended</option>
              </select>
          </div>
        </div>
         <label class="col-md-2 control-label" >Password Type</label> 
            <div class="col-md-3 inputGroupContainer">
            <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
              <select id="usrpasswordType" class="form-control"  type="select">
               <option value="TP">Temporary</option>
               <option value="PR">Permanent</option>
               </select>
            </div>
          </div>
        </div>
        <div class="form-group"> 
            <label class="col-md-2 control-label">E-mail</label>
            <div class="col-md-8 selectContainer">
            <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
            <input id="usremail" class="form-control"  type="email">
          </div>
        </div>
        </div>
        <!-- Select Basic -->
        
        <!-- Button -->
        <div class="form-group">
          <label class="col-md-4 control-label"></label>
          <div class="col-md-4"><br>
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button type="submit" class="btn btn-warning" >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspSUBMIT <span         class="glyphicon glyphicon-send"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</button>
           </div>
        </div>

</fieldset>
</form>
</div>
    </div><!-- /.container -->
    </div>
</div>