function myLeaveRequestForApprove() {
   approverLeaveRequestTableRow();
   var jsonInput = {
      "getCount": true,
      "onlyOpened": "true",
      "startIndex": 0,
      "rowCounts": totalItemPerPage
   };
   myLeaveRequestForApproveAJAX(jsonInput, myLeaveRequestsForApprove, true);
}

function myLeaveRequestForApproveByIndex(pageNumber) {
   let startIndex = (pageNumber - 1) * totalItemPerPage;
   approverLeaveRequestTableRow();
   var jsonInput = {
      "onlyOpened": "true",
      'startIndex': startIndex,
      'rowCounts': totalItemPerPage
   };
   myLeaveRequestForApproveAJAX(jsonInput, myLeaveRequestsForApproveNextPage, true);
}

function myLeaveRequestsForApprove(leaveRequests, totalCount) {
   totalPage = 0
   if (totalCount !== 0) {
      totalEmpCount = totalCount;
      totalPage = Math.ceil(totalEmpCount / totalItemPerPage);
   }
   myLeaveRequestsForApproveNextPage(leaveRequests, totalCount);
   apply_pagination(totalPage, myLeaveRequestForApproveByIndex);
}

function myLeaveRequestsForApproveNextPage(leaveRequests, totalCount) {
   $.each(leaveRequests, function(index, leaveRequest) {
      // Add a row to the table
      // First check if a <tbody> tag exists, add one if not
      if ($("#listTable tbody").length == 0) {
         $("#listTable").append("<tbody></tbody>");
      }
      // Append row to <table>
      $("#listTable tbody").append(
         approverLeaveRequestRow(leaveRequest));
   });
}

// Build a <tr> for a row of table data
function approverLeaveRequestRow(leaveRequest) {
   var row = "<tr>";
   row = row + "<td>" + leaveRequest.firstName + " ";
   row = row + leaveRequest.lastName + "</td>";
   row = row + "<td>" + leaveRequest.leaveType + "</td>";
   row = row + "<td>" + leaveRequest.startDate + "</td>";
   row = row + "<td>" + leaveRequest.endDate + "</td>";
   row = row + "<td>" + leaveRequest.leaveDays + "</td>";
   row = row + "<td>" + leaveRequest.leaveRqtState + "</td>";
   row = row + "<td >";
   row = row + "<button value='" + leaveRequest.reqId + "' class='btn btn-success edit-item btn-sm' onclick='approveLeaveRequest(this.value, true)'>Approve</button> ";
   row = row + "<button value='" + leaveRequest.reqId + "' class='btn btn-danger edit-item btn-sm' onclick='approveLeaveRequest(this.value, false)'>Reject</button> ";
   row = row + "<button value='" + leaveRequest.reqId + "' class='btn btn-warning view-item btn-sm' onclick='viewLeaveRequest(this.value)'>View</button>";
   row = row + "</td>";
   row = row + "</tr>";
   return row;
}

function sucessfullyApprovedLeave(message, status, data) {
   BootstrapDialog.alert("Inserted Successfully.");
   myLeaveRequestForApprove();
}

function approveRejectLeaveRequest(dataObj) {
   approveLeaveRequestAJAX(dataObj, sucessfullyApprovedLeave, false);
}

function approveLeaveRequest(reqId, approve) {
   let actionStr = approve ? "approve" : "reject";
   let status = approve ? "Approved" : "Rejected";
   var dataObj = {
      "reqId": reqId,
      "status": status
   };
   confirmAndExecute(approveRejectLeaveRequest, dataObj, "", actionStr);
}

function approverLeaveRequestTableRow() {
   $("#listTable tbody").remove();
}

/*
 * My Leave History
 */

function myLeaveRequestHistory() {
   myLeaveRequestTableRow();
   var jsonInput = {
      "getCount": true,
      "startIndex": 0,
      "rowCounts": totalItemPerPage
   };
   myLeaveRequestAJAX(jsonInput, myLeaveRequests, true);
}

function myLeaveRequestHistoryByIndex(pageNumber) {
   let startIndex = (pageNumber - 1) * totalItemPerPage;
   myLeaveRequestTableRow();
   var jsonInput = {
      'startIndex': startIndex,
      'rowCounts': totalItemPerPage
   };
   myLeaveRequestAJAX(jsonInput, myLeaveRequestsNextPage, true);
}

function myLeaveRequests(leaveRequests, totalCount) {
   totalPage = 0
   if (totalCount !== 0) {
      totalEmpCount = totalCount;
      totalPage = Math.ceil(totalEmpCount / totalItemPerPage);
   }
   myLeaveRequestsNextPage(leaveRequests, totalCount);
   apply_pagination(totalPage, myLeaveRequestHistoryByIndex);
}

function myLeaveRequestsNextPage(leaveRequests, totalCount) {
   $.each(leaveRequests, function(index, leaveRequest) {
      // Add a row to the table
      // First check if a <tbody> tag exists, add one if not
      if ($("#listTable tbody").length == 0) {
         $("#listTable").append("<tbody></tbody>");
      }
      // Append row to <table>
      $("#listTable tbody").append(
         myLeaveRequestRow(leaveRequest));
   });
}

// Build a <tr> for a row of table data
function myLeaveRequestRow(leaveRequest) {
   var row = "<tr>";
   row = row + "<td>" + leaveRequest.leaveType + "</td>";
   row = row + "<td>" + leaveRequest.startDate + "</td>";
   row = row + "<td>" + leaveRequest.endDate + "</td>";
   row = row + "<td>" + leaveRequest.status + "</td>";
   row = row + "<td>" + leaveRequest.leaveRqtState + "</td>";
   row = row + "<td >";
   row = row + "<button value='" + leaveRequest.reqId + "' class='btn btn-primary edit-item btn-sm' onclick='approveLeaveRequest(this.value)'>Revoke</button> ";
   row = row + "</td>";
   row = row + "</tr>";
   return row;
}

function myLeaveRequestTableRow() {
   $("#listTable tbody").remove();
}