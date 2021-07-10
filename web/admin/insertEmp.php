<div id="insertEmpModal" class="modal-form">
    <div class="modal-form-content">
        <div class="container">
    <span class="modal-form-close" onclick="closeModal('insertEmpModal')">&times;</span>
    <form class="well form-horizontal" action=" " method="post"  id="contact_form">
        <fieldset>

        <!-- Form Name -->
        <legend><center><h2><b id="empheader">Insert Employee</b></h2></center></legend><br>

        <!-- Text input-->

         <div class="form-group"> 
            <label class="col-md-2 control-label">First Name</label>
            <div class="col-md-3 selectContainer">
            <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input name="firstName" placeholder="First Name"  class="form-control"  type="text">
          </div>
        </div>
         <label class="col-md-2 control-label" >Last Name</label> 
            <div class="col-md-3 inputGroupContainer">
            <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
          <input name="lastName" placeholder="Last Name" class="form-control"  type="text">
            </div>
          </div>
        </div>
        
       
          <div class="form-group"> 
            <label class="col-md-2 control-label">Department</label>
            <div class="col-md-3 selectContainer">
            <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
            <input name="departmentId" placeholder="Department" class="form-control"  type="text">
          </div>
        </div>
         <label class="col-md-2 control-label" >Manager</label> 
            <div class="col-md-3 inputGroupContainer">
            <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
          <input name="manager" placeholder="Manager" class="form-control"  type="text">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-2 control-label" >Date of Birth</label> 
            <div class="col-md-3 inputGroupContainer">
            <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
          <input name="dateOfBirth" class="form-control"  type="date">
            </div>
          </div>
          <label class="col-md-2 control-label" >Date of Joining</label> 
            <div class="col-md-3 inputGroupContainer">
            <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
          <input name="dateOfJoining" class="form-control"  type="date">
            </div>
          </div>
        </div>
        
        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-2 control-label">E-Mail</label>  
            <div class="col-md-3 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
          <input name="email" placeholder="E-Mail Address" class="form-control"  type="text">
            </div>
          </div>
          <label class="col-md-2 control-label">Contact No.</label>  
            <div class="col-md-3 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
          <input name="contact_no" placeholder="(639)" class="form-control" type="text">
            </div>
          </div>
        </div>
        <!-- Text input-->
        
        <div class="form-group">
          <label class="col-md-2 control-label">Employee Id</label>  
          <div class="col-md-3 inputGroupContainer">
          <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
          <input  name="empId" placeholder="Employee Id" class="form-control"  type="text">
            </div>
          </div>
        </div>
        
        <!-- Select Basic -->
        
        <!-- Button -->
        <div class="form-group">
          <label class="col-md-4 control-label"></label>
          <div class="col-md-4"><br>
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button id= "empBtn" type="submit" class="btn btn-warning" >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspSUBMIT <span         class="glyphicon glyphicon-send"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</button>
           </div>
        </div>

</fieldset>
</form>
</div>
    </div><!-- /.container -->
    </div>
</div>