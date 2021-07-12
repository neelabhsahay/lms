<div id="updateLeaveModal" class="modal-form">
    <div class="modal-form-content">
        <div class="container">
    <span id="updateLeaveClose" onclick="closeModal('updateLeaveModal')" class="modal-form-close">&times;</span>
    <form class="well form-horizontal" action=" " method="post"  id="upLeaveForm" onsubmit="return updateLeave()">
        <fieldset>

        <!-- Form Name -->
        <legend><center><h2><b>Update Leave</b></h2></center></legend><br>

        <!-- Text input-->

         <div class="form-group"> 
            <label class="col-md-2 control-label">Leave Id</label>
            <div class="col-md-3 selectContainer">
            <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input name="leaveId" id="updateLeaveId" placeholder="Leave Id"  class="form-control"  type="text" readonly="true">
          </div>
        </div>
         <label class="col-md-2 control-label" >Leave Type</label> 
            <div class="col-md-3 inputGroupContainer">
            <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
          <input name="leaveType" id="updateLeaveType" placeholder="Leave Type" class="form-control"  type="text">
            </div>
          </div>
        </div>
        
       
          <div class="form-group"> 
            <label class="col-md-2 control-label">Leave Max</label>
            <div class="col-md-3 selectContainer">
            <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
            <input name="leaveMax" id="updateLeaveMax" placeholder="Leave Max" class="form-control"  type="text">
          </div>
        </div>
         <label class="col-md-2 control-label" >Leave Max Pro</label> 
            <div class="col-md-3 inputGroupContainer">
            <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
          <input name="leaveProvMax" id="updateLeaveProvMax" placeholder="Leave Max Pro" class="form-control"  type="text">
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
