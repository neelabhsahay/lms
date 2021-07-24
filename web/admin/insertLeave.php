<div id="insertLeaveModal" class="modal-form">
    <div class="modal-form-content">
        <div class="container">
    <span id="insertLeaveClose" onclick="closeDisplayForm('insertLeaveModal', 'leaveForm')" class="modal-form-close">&times;</span>
    <form action=" " method="post"  id="leaveForm" onsubmit="return insertLeave()">
        <fieldset>

        <!-- Form Name -->
        <legend class="legent-header border-bottom"><center><h4>Leave Details</h4></center></legend><br>
         <div class="row mb-4"> 
            <label class="col-md-3 control-label">Leave Id</label>
            <div class="col-md-3 selectContainer">
            <input name="leaveId" placeholder="Leave Id"  class="form-control"  type="text">
        </div>
         <label class="col-md-3 control-label" >Leave Type</label> 
            <div class="col-md-3 inputGroupContainer">
             <input name="leaveType" placeholder="Leave Type" class="form-control"  type="text">
          </div>
        </div>
        
       
          <div class="row mb-4"> 
            <label class="col-md-3 control-label">Leave Max</label>
            <div class="col-md-3 selectContainer">
               <input name="leaveMax" placeholder="Leave Max" class="form-control"  type="text">
          </div>
         <label class="col-md-3 control-label" >Leave Max Pro</label> 
            <div class="col-md-3 inputGroupContainer">
           <input name="leaveProvMax" placeholder="Leave Max Pro" class="form-control"  type="text">
          </div>
        </div>
        <!-- Select Basic -->
        
        <!-- Button -->
        <div class="row mb-4">
         <div class="col-md-12">
         <div class="mt-5 text-center">
          <button type="submit" id="leaveBtn" class="btn btn-primary profile-button" >SUBMIT</button>
        </div>
        </div>
        </div>
</fieldset>
</form>
</div>
    </div><!-- /.container -->
    </div>
</div>