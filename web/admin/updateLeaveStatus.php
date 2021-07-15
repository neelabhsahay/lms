<div id="updateLeaveStatusModal" class="modal-form">
    <div class="modal-form-content">
        <div class="container">
    <span class="modal-form-close" onclick="closeDisplayForm('updateLeaveStatusModal', 'upLeaveStatusForm')">&times;</span>
    <form class="well form-horizontal" action=" " method="post"  id="upLeaveStatusForm" onsubmit="return updateLeaveStatus()">
        <fieldset>

        <!-- Form Name -->
        <legend><center><h2><b>Update Leave Status</b></h2></center></legend><br>

        <!-- Text input-->

         <div class="form-group"> 
            <label class="col-md-2 control-label">Employee Name</label>
            <div class="col-md-3 selectContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input name="employeeName" placeholder="Employee Name"  class="form-control"  type="text" readonly="true">
                </div>
            </div>
            <label class="col-md-2 control-label" >Leave Type</label> 
            <div class="col-md-3 inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input name="leaveType" placeholder="Leave Name" class="form-control"  type="text" readonly="true">
                </div>
            </div>
         </div>
         <div class="form-group"> 
            <label class="col-md-2 control-label">Employee Id</label>
            <div class="col-md-3 selectContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input name="empId" placeholder="Employee Id"  class="form-control"  type="text" readonly="true">
                </div>
            </div>
            <label class="col-md-2 control-label" >Leave Id</label> 
            <div class="col-md-3 inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input name="leaveId" placeholder="Leave Id" class="form-control"  type="text" readonly="true">
                </div>
            </div>
         </div>
       
          <div class="form-group"> 
            <label class="col-md-2 control-label">Leave Carried</label>
            <div class="col-md-3 selectContainer">
            <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
            <input name="leaveCarried" placeholder="Leave Carried" class="form-control"  type="number" min="1" max="30" step="0.5">
          </div>
        </div>
         <label class="col-md-2 control-label" >Leave In Year</label> 
            <div class="col-md-3 inputGroupContainer">
            <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
          <input name="leaveInYear" placeholder="Leave In Year" class="form-control"  type="number" min="1" max="30" step="0.5">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-2 control-label" >Leave Used</label> 
          <div class="col-md-3 inputGroupContainer">
              <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                  <input name="leaveUsed" class="form-control"  type="number" min="1" max="50" step="0.5">
              </div>
          </div>
          <label class="col-md-2 control-label" >Year</label> 
          <div class="col-md-3 inputGroupContainer">
              <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                  <input name="year"  type="text" class="form-control" readonly="true" />
              </div>
          </div>
        </div>
        
        
        <!-- Select Basic -->
        
        <!-- Button -->
        <div class="form-group">
          <label class="col-md-4 control-label"></label>
          <div class="col-md-4"><br>
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button type="submit" class="btn btn-warning" >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspUPDATE <span         class="glyphicon glyphicon-send"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</button>
           </div>
        </div>

    </fieldset>
</form>
</div>
    </div><!-- /.container -->
    </div>
</div>