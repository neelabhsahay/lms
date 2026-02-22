function fillLeaveRequestForm(leaveRequest) {
   $("#viewLeaveForm").setFormDataFromJSON(leaveRequest[0]);

   let name = document.getElementById('viewRequesterName');
   let email = document.getElementById('viewRequesterEmail');
   name.textContent = leaveRequest[0].firstName + " " + leaveRequest[0].lastName;
   email.textContent = leaveRequest[0].email;
   let viewApprover = document.getElementById('viewApproverSec');
   viewApprover.hidden = true;
   displayModal('viewLeaveModal');
}

function viewLeaveRequest(reqId) {
   var jsonInput = {
      "reqId": reqId
   };
   empLeaveRequestAJAX(jsonInput, fillLeaveRequestForm, false);
}