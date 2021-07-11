<div id="updateEmpModal" class="modal-form">
    <div class="modal-form-content">
        <div class="container">
    <span class="modal-form-close" onclick="closeModal('updateEmpModal')">&times;</span>
    <form class="well form-horizontal" action=" " method="post"  id="upEmpForm" onsubmit="return updateEmp()">
        <fieldset>

        <!-- Form Name -->
        <legend><center><h2><b>Employee Details</b></h2></center></legend><br>

        <!-- Text input-->

         <div class="form-group"> 
            <label class="col-md-2 control-label">First Name</label>
            <div class="col-md-3 selectContainer">
            <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input name="firstName" id="updateFirstName" placeholder="First Name"  class="form-control"  type="text">
          </div>
        </div>
         <label class="col-md-2 control-label" >Last Name</label> 
            <div class="col-md-3 inputGroupContainer">
            <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
          <input name="lastName" id="updateLastName" placeholder="Last Name" class="form-control"  type="text">
            </div>
          </div>
        </div>
        
       
          <div class="form-group"> 
            <label class="col-md-2 control-label">Manager Name</label>
            <div class="col-md-3 selectContainer">
            <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
            <input name="managerName" id="updateManagerName" placeholder="Manager Name" class="form-control"  type="text">
          </div>
        </div>
         <label class="col-md-2 control-label" >Manager</label> 
            <div class="col-md-3 inputGroupContainer">
            <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
          <input name="manager" id="updateManager"  placeholder="Manager" class="form-control"  type="text" readonly>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-2 control-label" >Date of Birth</label> 
            <div class="col-md-3 inputGroupContainer">
            <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
          <input name="dateOfBirth" id="updateDateOfBirth" class="form-control"  type="date">
            </div>
          </div>
          <label class="col-md-2 control-label" >Date of Joining</label> 
            <div class="col-md-3 inputGroupContainer">
            <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
          <input name="dateOfJoin" id="updateDateOfJoining" class="form-control"  type="date">
            </div>
          </div>
        </div>
        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-2 control-label">Employee Id</label>  
          <div class="col-md-3 inputGroupContainer">
          <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
          <input  name="empId" id="updateEmpId" placeholder="Employee Id" class="form-control"  type="text">
            </div>
          </div>
          <label class="col-md-2 control-label">Department</label>
            <div class="col-md-3 selectContainer">
            <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
            <input name="departmentId" id="updateDepartmentId" placeholder="Department" class="form-control"  type="text">
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
          <input name="contact" id="updateContactNo" placeholder="(639)" class="form-control" type="text">
            </div>
          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-2 control-label">Employee Type</label>  
            <div class="col-md-3 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
          <select name="empType" class="form-control"  type="select">
                    <option value="PRO">Provistion</option>
                    <option value="PER">Permanent</option>
                    <option value="TMP">Temporary</option>
                    <option value="INT">Intern</option>
                    <option value="CNT">Contractor</option>
              </select>
            </div>
          </div>
          <label class="col-md-2 control-label">Employee Status</label>  
            <div class="col-md-3 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                <select name="empStatus" class="form-control"  type="select">
                    <option value="ACT">Active</option>
                    <option value="INA">In-Active</option>
              </select>
            </div>
          </div>
        </div>
        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-2 control-label">Location</label>  
            <div class="col-md-3 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
          <input name="location" placeholder="Location" class="form-control"  type="text">
            </div>
          </div>
          <label class="col-md-2 control-label">Employee Role</label>  
            <div class="col-md-3 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
          <input name="empRole" placeholder="Employee Role" class="form-control" type="text">
            </div>
          </div>
        </div>
        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-2 control-label">Employee Id</label>  
          <div class="col-md-3 inputGroupContainer">
          <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
          <input  name="empId" id="updateEmpId" placeholder="Employee Id" class="form-control"  type="text">
            </div>
          </div>
          <label class="col-md-2 control-label">Department</label>
            <div class="col-md-3 selectContainer">
            <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
            <input name="departmentId" id="updateDepartmentId" placeholder="Department" class="form-control"  type="text">
          </div>
        </div>
        </div>
        
        <!-- Select Basic -->
        
        <!-- Button -->
        <div class="form-group">
          <label class="col-md-4 control-label"></label>
          <!-- <div class="col-md-4"><br>
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button type="submit" class="btn btn-warning" >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspUPDATE <span         class="glyphicon glyphicon-send"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</button>
           </div> -->
           <div class="col-md-4"><br>
            <button type="submit" class="btn btn-warning" > UPDATE <span class="glyphicon glyphicon-send"></span></button>
           </div>
        </div>

</fieldset>
</form>
</div>
    </div><!-- /.container -->
    </div>
</div>