<div id="updateLeaveStatusModal" class="modal-form">
    <div class="modal-form-content">
        <span class="modal-form-close" onclick="closeDisplayForm('updateLeaveStatusModal', 'upLeaveStatusForm')">&times;</span>
        <div class="container">
    
        <form action=" " method="post"  id="upLeaveStatusForm" onsubmit="return updateLeaveStatus()">
        <!-- Form Name -->
        <legend class="legent-header border-bottom"><center><h2><b>Update Leave Status</b></h2></center></legend><br>

        <!-- Text input-->
 
         <div class="row mb-4">
            <label class="col-md-3 control-label">Employee Name</label>
            <div class="col-md-3">
                
                <input name="employeeName" placeholder="Employee Name"  class="form-control"  type="text" readonly="true">
            </div>
            <label class="col-md-3 control-label" >Leave Type</label> 
            <div class="col-md-3">
                
                <input name="leaveType" placeholder="Leave Name" class="form-control"  type="text" readonly="true">
            </div>
         </div>
         <div class="row mb-4"> 
             <label class="col-md-3 control-label" >Employee Id</label> 
            <div class="col-md-3">
             
              <input name="empId" placeholder="Employee Id"  class="form-control"  type="text" readonly="true">
          </div>    
          <label class="col-md-3 control-label" >Leave Id</label> 
          <div class="col-md-3">
            
              <input name="leaveId" placeholder="Leave Id" class="form-control"  type="text" readonly="true">
          </div>
        </div>
        <div class="row mb-4">  
        <label class="col-md-3 control-label" >Leave Carried</label>         
          <div class="col-md-3">
              
              <input name="leaveCarried" placeholder="Leave Carried" class="form-control"  type="number" min="0" max="30" step="0.5">
          </div>    
          <label class="col-md-3 control-label" >Leave In Year</label> 
          <div class="col-md-3">
            
              <input name="leaveInYear" placeholder="Leave In Year" class="form-control"  type="number" min="1" max="30" step="0.5">
          </div>
        </div>
        <div class="row mb-4">  
        <label class="col-md-3 control-label" >Leave Used</label>         
             <div class="col-md-3">
              
              <input name="leaveUsed" class="form-control"  type="number" min="1" max="50" step="0.5">
            </div>
          <label class="col-md-3 control-label" >Year</label> 
            <div class="col-md-3">
                
                <input name="year"  type="text" class="form-control" readonly="true" />
            </div>
        </div>
        
        <!-- Button -->
        <div class="row mb-4">

          <div class="col-md-12">
            <button type="submit" class="btn btn-primary profile-button" >UPDATE</button>
           </div>
        </div>
    </form>
</div>
</div>
</div>