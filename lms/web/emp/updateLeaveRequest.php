<div id="applyLeaveModal" class="modal-form">
 <div class="modal-form-content">
   <span class="modal-form-close" onclick="closeDisplayForm('applyLeaveModal', 'applyLeaveForm')">&times;</span>
   <div class="container rounded bg-white ">
     <form  action=" " method="post"  id="applyLeaveForm" onsubmit="return applyForLeave()">
      <div class="col-md-4 border-right">
       <div class="d-flex flex-column align-items-center text-center p-3 py-5">
        <img class="rounded-circle mt-5" src="http://localhost/lms/web/asserts/img/user.jpg">
        <span id="name" class="font-weight-bold">Aashvi Sahay</span>
        <span id="email" class="text-black-50">aashvi@aashvi.com</span>
        <span> </span>
     </div>
  </div>
  
  <div class="col-md-8">
    <div class="p-3 py-5">
     <div class="d-flex justify-content-between align-items-center mb-3">
      <h4 class="text-right">Apply Leave</h4>
   </div>
   <div class="row mt-6">
      <div class="col-md-6">
       <label class="labels">Start Date</label>
       <input id="alStartDate" name='startDate' type="date" class="form-control">
    </div>
    <div class="col-md-6">
       <label class="labels">End Date</label>
       <input id="alEndDate"  name='endDate' type="date" class="form-control">
    </div>
 </div>
 <div class="row mt-6">
   <div class="col-md-12">
    <label class="labels">Approver</label>
    <input id="alApproverId" name="approver" type="text" class="form-control" readonly="true" hidden="true" >
    <input id="alApprover" name="approverName" type="text" class="form-control" readonly="true" >
 </div>
</div>
</div>
<div class="p-3 py-5">
  <div class="row mt-6">
   <div class="col-md-6">
    <label class="labels">No of Days</label>
    <input id="alNoOfDays" name='leaveDays' type="text" class="form-control">
 </div>
 <div class="col-md-6">
    <label class="labels">Leave Type</label>
    <select id="alLeaveId" name='leaveId' class="form-control" placeholder="Select Leave Type">
       <option value="">Select Leave</option>
    </select>
 </div>
</div>
<div class="row mt-6">
   <div class="col-md-12">
    <label class="labels">Notifier List ( comma sperated )</label>
    <input name="notifier" type="text" class="form-control" placeholder="Notifier list">
 </div>
</div>
</div>

<div class="mt-5 text-center"  >
 <label class="labels">Reason of Leave</label>
 <textarea id="reason" name="reason" class="form-control" maxlength="400"></textarea>
</div>
<div class="mt-5 text-center"  >
 <button class="btn btn-primary profile-button" type="submit" >Apply Leave</button>
</div>
</div>
</form>
</div>
</div>
</div>