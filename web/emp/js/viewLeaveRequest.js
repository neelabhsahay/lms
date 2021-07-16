function viewLeaveRequest() {
   var jsonInput = {
      "approver": nowYear
   };
   empLeaveRequestAJAX();
}

function approverLeaveRequests(leaveRequests) {
   $.each(leaveRequests, function(index, leaveRequest) {
      // Add a row to the table
      approverLeaveRequest(leaveRequest);
   });
}

// Add Product row to <table>

function approverLeaveRequest(leaveRequest) {
   // First check if a <tbody> tag exists, add one if not
   if ($("#leaveRequestApproverTable tbody").length == 0) {
      $("#leaveRequestApproverTable").append("<tbody></tbody>");
   }
   // Append row to <table>
   $("#leaveRequestApproverTable tbody").append(
      approverLeaveRequestRow(leaveRequest));
}

// Build a <tr> for a row of table data
function approverLeaveRequestRow(leaveRequest) {
   var row = "<tr>";
   row = row + "<td>" + leaveRequest.leaveType + "</td>";
   row = row + "<td>" + leaveRequest.firstName + " ";
   row = row + leaveRequest.lastName + "</td>";
   row = row + "<td>" + leaveRequest.startDate + "</td>";
   row = row + "<td>" + leaveRequest.endDate + "</td>";
   row = row + "<td >";
   row = row + "<button value='" + leaveRequest.reqId + "' class='btn btn-primary edit-item' onclick='approveLeaveRequest(this.value)'>Edit</button> " +
      "<button value='" + leaveRequest.reqId + "' class='btn btn-warning view-item' onclick='rejectLeaveRequest(this.value)'>View</button>";
   row = row + "</td>";
   row = row + "</tr>";
   return row;
}

/*
 * My Leave History
 */

function myLeaveRequestHistory() {
   var jsonInput = {};
   myLeaveRequestAJAX(jsonInput, myLeaveRequests, true);
}

function myLeaveRequests(leaveRequests) {
   $.each(leaveRequests, function(index, leaveRequest) {
      // Add a row to the table
      myLeaveRequest(leaveRequest);
   });
}

function myLeaveRequest(leaveRequest) {
   // First check if a <tbody> tag exists, add one if not
   if ($("#leaveRequestHistoryTable tbody").length == 0) {
      $("#leaveRequestHistoryTable").append("<tbody></tbody>");
   }
   // Append row to <table>
   $("#leaveRequestHistoryTable tbody").append(
      myLeaveRequestRow(leaveRequest));
}

// Build a <tr> for a row of table data
function myLeaveRequestRow(leaveRequest) {
   var row = "<tr>";
   row = row + "<td>" + leaveRequest.leaveId + "</td>";
   row = row + "<td>" + leaveRequest.startDate + "</td>";
   row = row + "<td>" + leaveRequest.endDate + "</td>";
   row = row + "<td>" + leaveRequest.status + "</td>";
   row = row + "<td>" + leaveRequest.leaveRqtState + "</td>";
   row = row + "<td >";
   row = row + "<button value='" + leaveRequest.reqId + "' class='btn btn-primary edit-item' onclick='approveLeaveRequest(this.value)'>Revoke</button> ";
   row = row + "</td>";
   row = row + "</tr>";
   return row;
}