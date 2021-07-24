<div id="insertUserModal" class="modal-form">
   <div class="modal-form-content">
<span id="insertLeaveClose" onclick="closeDisplayForm('insertUserModal', 'userForm')" class="modal-form-close float-right">&times;</span>
   <div class="container">
    
    <form action=" " method="post"  id="userForm" onsubmit="return insertUpdateUser()">
        <fieldset>

        <!-- Form Name -->
        <legend class="legent-header border-bottom"><center><h4>User Details</h4></center>
        </legend><br>

        <!-- Text input-->

         <div class="row mb-4"> 
            <label class="col-md-3 control-label" >Username</label> 
            <div class="col-md-3 inputGroupContainer">
             <input name="username" id="username" placeholder="Username" class="form-control"  type="text">
          </div>
            <label class="col-md-3 control-label">Employee</label>
            <div class="col-md-3 selectContainer">
            <input name="empId" placeholder="Employee"  class="form-control"  type="text">
          </div>
         
        </div>       
       <div class="row mb-4"> 
            <label class="col-md-3 control-label" >Password</label> 
            <div class="col-md-3 inputGroupContainer">
            <input name="password" placeholder="Password" class="form-control"  type="password">
          </div>
            <label class="col-md-3 control-label">Re-Password</label>
            <div class="col-md-3 selectContainer">
            <input name="repassword" placeholder="Re-password"  class="form-control"  type="password">
          </div>
         
        </div>  
          <div class="row mb-4"> 
            <label class="col-md-3 control-label">Account Type</label>
            <div class="col-md-3 selectContainer">
            <select name="accountType" class="form-control"  type="select">
                <option value="EMP">Employee</option>
                <option value="ADM">Admin</option>
                <option value="SUP">Suspended</option>
              </select>
             </div>
            <label class="col-md-3 control-label" >Password Type</label> 
            <div class="col-md-3 inputGroupContainer">
            <select name="passwordType" class="form-control"  type="select">
               <option value="TP">Temporary</option>
               <option value="PR">Permanent</option>
               </select>
          </div>
        </div>
        <div class="row mb-4"> 
            <label class="col-md-3 control-label">E-mail</label>
            <div class="col-md-9 selectContainer">
            <input name="email" class="form-control"  type="email">
          </div>
        </div>
        <!-- Select Basic -->
        
        <!-- Button -->
        <div class="row mb-4">
         <div class="col-md-12">
         <div class="mt-5 text-center">
          <button type="submit" id="insertUserbtn" class="btn btn-primary profile-button" >SUBMIT</button>
        </div>
        </div>
        </div>

</fieldset>
</form>
</div>
    </div><!-- /.container -->
    </div>
</div>