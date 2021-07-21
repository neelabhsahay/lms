<div id="viewLeaveModal" class="modal-form">
  <div class="modal-form-content">
    <span class="modal-form-close" onclick="closeDisplayForm('viewLeaveModal', 'viewLeaveForm')">&times;</span>
    <div class="container rounded bg-white ">
      <form  action=" " method="post"  id="viewLeaveForm">
          <div class="row">
              <div class="col-md-4 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                  <img class="rounded-circle mt-5" src="http://localhost/lms/web/assets/img/user.jpg">
                  <span id="viewRequesterName" class="font-weight-bold">Aashvi Sahay</span>
                  <span id="viewRequesterEmail" class="text-black-50">aashvi@ashvi.com</span>
                  <span> </span>
                </div>
              </div>
              <div class="col-md-8">
                <div class="p-3 py-5">
                  <div class="row mt-3">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Leave Request</h4>
                  </div>
                  </div>
                  <div class="row mt-3">
                    <div class="col-md-6">
                      <label class="col-form-label">Start Date</label>
                      <input name='startDate' type="text" class="form-control form-control-plaintext" readonly="true">
                    </div>
                    <div class="col-md-6">
                      <label class="col-form-label">End Date</label>
                      <input name='endDate' type="text" class="form-control" readonly="true">
                    </div>
                  </div>
                  <div class="row mt-3">
                    <div class="col-md-12" id='viewApproverSec'>
                      <label class="col-form-label">Approver</label>
                      <input name="approver" type="text" class="form-control" readonly="true" hidden="true" >
                      <input name="approverName" type="text" class="form-control" readonly="true" >
                    </div>
                    <div class="col-md-6">
                      <label class="col-form-label">No of Days</label>
                      <input name='leaveDays' type="text" class="form-control" readonly="true">
                    </div>
                    <div class="col-md-6">
                      <label class="col-form-label">Leave Type</label>
                      <input name='leaveType' class="form-control" placeholder="Select Leave Type" readonly="true">
                    </div>
                  </div>
                  <div class="mt-5 text-center"  >
                    <label class="col-form-label">Reason of Leave</label>
                    <textarea id="reason" name="reason" class="form-control" maxlength="400" readonly="true"></textarea>
                  </div>
                  <div class="mt-5 text-center" id="empProfilebtn">
                      <button class="btn btn-primary profile-button" type="submit" >Revoke Leave</button>
                   </div>
                </div>
              </div>
          </div>
      </form>
    </div>
  </div>
</div>