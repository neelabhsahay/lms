<div id="insertLeaveStatusModal" class="modal-form">
    <div class="modal-form-content">
        <span class="modal-form-close" onclick="closeDisplayForm('insertLeaveStatusModal', 'leaveStatusForm')">&times;</span>
        <div class="container">
    
    <form action=" " method="post"  id="leaveStatusForm" onsubmit="return insertLeaveStatus()">
        <fieldset>
        <legend class="legent-header border-bottom"><center><h2><b id="leaveStatusheader">Leave Status Details</b></h2></center></legend><br>
         <div class="row mb-4"> 
            <label class="col-md-3 control-label">Employee Name</label>
            <div class="col-md-3 control-label">
                <div class="input-group">
                    <input id="lvstEmployeeName" name="employeeName" placeholder="Employee Name" class="form-control" type="text" onkeyup="searchEmpForLeave(this.value)">
                    
                </div>
            </div>
            <label class="col-md-3 control-label" >Leave Type</label> 
            <div class="col-md-3 control-label">
                <div class="input-group">
                    <select id="lvstLeaveId" name="leaveId" placeholder="Leave Name" class="form-control" type="select" >
                        <option value="">Select Leave</option>
                    </select> 
                </div>
            </div>
         </div>
         <div class="row mb-4">            
            
            <label class="col-md-3 control-label">Employee Id</label>
            <div class="col-md-3 control-label">
                <input name="empId" id="lvstEmpId" placeholder="Employee Id"  class="form-control"  type="text" readonly="true">
            </div>
            <label class="col-md-3 control-label" >Year</label>
            <div class="col-md-3 control-label">
                    <input name="year"
                        type="text"
                        class="yearpicker form-control"
                        value=""
                      />
                </div>
          </div>
       
          <div class="row mb-4"> 
            <label class="col-md-3 control-label">Leave Carried</label>
            <div class="col-md-3 control-label" >
                 <input name="leaveCarried" placeholder="Leave Carried" class="form-control"  type="number" min="1" max="30" step="0.5">
            </div>
            <label class="col-md-3 control-label" >Leave In Year</label> 
            <div class="col-md-3 control-label">
              <input name="leaveInYear" placeholder="Leave In Year" class="form-control"  type="number" min="1" max="30" step="0.5">
            </div>
        </div>
        <div class="row mb-4">
           <label class="col-md-3 control-label" >Leave Used</label>
          <div class="col-md-3 control-label">
             <input name="leaveUsed" class="form-control"  type="number" min="1" max="50" step="0.5">
          </div>
        </div>
        <!-- Button -->
        <div class="row mb-4">
          <div class="col-md-12">
            <button type="submit" class="btn btn-primary profile-button" >SUBMIT</button>
           </div>
        </div>

</fieldset>
</form>
</div>
</div><!-- /.container -->
</div>