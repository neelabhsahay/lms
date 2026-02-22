<div id="updateLeaveModal" class="modal-form">
    <div class="modal-form-content">
      <span id="updateLeaveClose" onclick="closeDisplayForm('updateLeaveModal', 'upLeaveForm')" class="modal-form-close">&times;</span>
      <div class="container">
    
    <form action=" " method="post"  id="upLeaveForm" onsubmit="return updateLeave()">
        <fieldset>

        <!-- Form Name -->
        <legend class="legent-header border-bottom"><center><h4>Update Leave</h4></center></legend><br>

        <!-- Text input-->

         <div class="row mb-4"> 
            <label class="col-md-3 control-label">Leave Id</label>
            <div class="col-md-3 selectContainer">
            <input name="leaveId" id="updateLeaveId" placeholder="Leave Id"  class="form-control"  type="text" readonly="true">
        </div>
         <label class="col-md-3 control-label" >Leave Type</label> 
            <div class="col-md-3 inputGroupContainer">
            <input name="leaveType" id="updateLeaveType" placeholder="Leave Type" class="form-control"  type="text">
            </div>
        </div>
        
       
          <div class="row mb-4"> 
            <label class="col-md-3 control-label">Leave Max</label>
            <div class="col-md-3 selectContainer">
            <input name="leaveMax" id="updateLeaveMax" placeholder="Leave Max" class="form-control"  type="text">
          </div>
         <label class="col-md-3 control-label" >Leave Max Pro</label> 
            <div class="col-md-3 inputGroupContainer">
             <input name="leaveProvMax" id="updateLeaveProvMax" placeholder="Leave Max Pro" class="form-control"  type="text">
          </div>
        </div>
        <!-- Select Basic -->
        
        <!-- Button -->
        <div class="row mb-4">
         <div class="col-md-12">
         <div class="mt-5 text-center">
          <button type="submit" class="btn btn-primary profile-button" >UPDATE</button>
        </div>
        </div>
        </div>

</fieldset>
</form>
</div>
    </div><!-- /.container -->
    </div>
</div>
