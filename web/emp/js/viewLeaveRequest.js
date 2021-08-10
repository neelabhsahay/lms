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
   row = row + "<div class='btn-group' >";
   row = row + "<button value='" + leaveRequest.reqId + "' class='btn btn-sm btn-success dropdown-toggle-split' onclick='approveLeaveRequest(this.value, true)'>Approve</button> ";
   row = row + "<button class='btn btn-success dropdown-toggle btn-sm' style='padding: 15px;' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>";
   row = row + "<span class='caret'></span><span class='sr-only'>Toggle Dropdown</span></button> ";
   row = row + "<div class='dropdown-menu'>";
   row = row + "<button value='" + leaveRequest.reqId + "'class='dropdown-item' onclick='approveLeaveRequest(this.value, false)'>Reject</button>";
   row = row + "<button value='" + leaveRequest.reqId + "'class='dropdown-item' onclick='viewLeaveRequest(this.value)'>View</button>";
   row = row + "</div>";
   row = row + "</div>";
   row = row + "</td>";
   row = row + "</tr>";
   return row;
}

function sucessfullyApprovedLeave(message, status, data) {
   if (status == 'failed') {
      var msg = "";
      msg += "Reason: " + message + "\n";
      msg += "Text:" + "\n";
      msg += "    Leave Start Date: " + data.startDate + "\n";
      msg += "          Today Date: " + data.today + "\n";
      BootstrapDialog.alert(msg);
   } else {
      BootstrapDialog.alert("Inserted Successfully.");
      myLeaveRequestForApprove();
   }
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
   row = row + "<button value='" + leaveRequest.reqId + "' class='btn btn-primary edit-item btn-sm' onclick='revokeLeaveRequest(this.value)'>Revoke</button> ";
   row = row + "</td>";
   row = row + "</tr>";
   return row;
}

function myLeaveRequestTableRow() {
   $("#listTable tbody").remove();
}

function sucessfullyRevokedLeave(message, status, data) {
   if (status == 'failed') {
      var msg = "";
      msg += "Reason: " + message + "\n";
      msg += "Text:" + "\n";
      msg += "    Leave Start Date: " + data.startDate + "\n";
      msg += "          Today Date: " + data.today + "\n";
      BootstrapDialog.alert(msg);
   } else {
      BootstrapDialog.alert("Revoked Successfully.");
      myLeaveRequestHistory();
   }
}


function revokeMyLeaveRequest(dataObj, revokeCb) {
   revokeLeaveRequestAJAX(dataObj, revokeCb, false);
}

function revokeLeaveRequest(reqId) {
   var dataObj = {
      "reqId": reqId,
   };
   confirmAndExecute(revokeMyLeaveRequest, dataObj, sucessfullyRevokedLeave, "revoke ");
   return false;
}

function sucessfullyMyRevokedLeave(message, status, data) {
   if (status == 'failed') {
      var msg = "";
      msg += "Reason: " + message + "\n";
      msg += "Text:" + "\n";
      msg += "    Leave Start Date: " + data.startDate + "\n";
      msg += "          Today Date: " + data.today + "\n";
      BootstrapDialog.alert(msg);
   } else {
      BootstrapDialog.alert("Revoked Successfully.");
   }
   closeDisplayForm('viewLeaveModal', 'viewLeaveForm');
}

function submitRevokeLeaveRequest() {
   var dataObj = {
      "reqId": document.getElementById('reqId').value
   };
   confirmAndExecute(revokeMyLeaveRequest, dataObj, sucessfullyMyRevokedLeave, "revoke ");
   loadCalendar();
   return false;
}