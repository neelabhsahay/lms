function insertLeaveStatusCb(message, status, data) {
   BootstrapDialog.alert("Inserted Successfully.");
   closeModal("insertLeaveStatusModal");
   loadListLeaveStatus();
}

function updateLeaveStatusCb(message, status, data) {
   BootstrapDialog.alert("Updation Successfully.");
   closeModal("updateLeaveStatusModal");
   loadListLeaveStatus();
}

/*
 * List Section and on Load section
 **********************************
 */
function lvStInfo(lvsts, totalCount) {
   totalPage = 0;
   if (totalCount !== null) {
      totalEmpCount = totalCount;
      totalPage = Math.ceil(totalEmpCount / totalItemPerPage);
   }
   $.each(lvsts, function(index, lvst) {
      // Add a row to the Product table
      lvStAddRow(lvst);
   });
   apply_pagination(totalPage, loadLeaveStatusByIndex);
}

function lvStInfoNextPage(lvsts, totalCount) {
   $.each(lvsts, function(index, lvst) {
      // Add a row to the Product table
      lvStAddRow(lvst);
   });
}

// Add Product row to <table>
function lvStAddRow(lvst) {
   // First check if a <tbody> tag exists, add one if not
   if ($("#lvStTable tbody").length == 0) {
      $("#lvStTable").append("<tbody></tbody>");
   }
   // Append row to <table>
   $("#lvStTable tbody").append(
      lvStTableRow(lvst));
}
// Build a <tr> for a row of table data
function lvStTableRow(lvst) {
   var row = "<tr>";
   row = row + "<td>" + lvst.employeeName + "</td>";
   row = row + "<td>" + lvst.leaveType + "</td>";
   row = row + "<td>" + lvst.year + "</td>";
   row = row + "<td>" + lvst.leaveCarried + "</td>";
   row = row + "<td>" + lvst.leaveInYear + "</td>";
   row = row + "<td>" + lvst.leaveUsed + "</td>";
   row = row + "<td >";
   row = row + "<button value='" + lvst.leaveId + "+" + lvst.empId + "+" + lvst.year + "'";
   row = row + "class='btn btn-primary edit-item btn-sm' onclick='viewLeaveStatus(this.value)'>Edit</button>";
   row = row + "</td>";
   row = row + "</tr>";

   return row;
}

function clearLeaveStatusTableRow() {
   $("#lvStTable tbody").remove();
}

function loadListLeaveStatus() {
   clearLeaveStatusTableRow();
   var jsonInput = {
      "getCount": true,
      "startIndex": 0,
      "rowCounts": totalItemPerPage
   };
   leaveStatusListAJAX(jsonInput, lvStInfo, false);
}

function displayLeaveStatus() {
   var jsonInput = {};
   leaveListAJAX(jsonInput, updateLeavePresent, false);
   displayModal('insertLeaveStatusModal');
}

/*
 * Update section of code 
 *************************
 */
function fillLeaveStatusForm(leaveStatus) {
   $("#upLeaveStatusForm").setFormDataFromJSON(leaveStatus[0]);
   displayModal("updateLeaveStatusModal");
}

function viewLeaveStatus(keys) {
   var keyArr = keys.split("+");
   var jsonInput = {
      "leaveId": keyArr[0],
      "empId": keyArr[1],
      "year": keyArr[2]
   };
   leaveStatusListAJAX(jsonInput, fillLeaveStatusForm, false);
}

function updateLeaveStatus() {
   var dataObj = $("#upLeaveStatusForm").serializeFormJSON();
   confirmAndExecute(updateLeaveStatusAJAX, dataObj, updateLeaveStatusCb,
      "update leave status");
   return false;
}


/*
 * Insert New section of code 
 *************************
 */

function insertLeaveStatus() {
   var dataObj = $("#leaveStatusForm").serializeFormJSON();
   confirmAndExecute(insertLeaveStatusAJAX, dataObj, insertLeaveStatusCb,
      "insert leave status");
   return false;
}


function updateLeavePresent(leaveList) {
   var x = document.getElementById("lvstLeaveId");
   var length = x.options.length;
   for (i = length - 1; i >= 1; i--) {
      select.options[i] = null;
   }
   $.each(leaveList, function(index, leave) {
      var option = document.createElement("option");
      option.text = leave.leaveType;
      option.value = leave.leaveId;
      x.add(option);
   });
}

function insertLeaveStatus() {
   var dataObj = $("#leaveStatusForm").serializeFormJSON();
   confirmAndExecute(insertLeaveStatusAjax, dataObj, "insert leave status");
   return false;
}

/*
 * Paging section of code
 */

function loadLeaveStatusByIndex(pageNumber) {

   let startIndex = (pageNumber - 1) * totalItemPerPage;
   clearLeaveStatusTableRow();
   var jsonInput = {
      'startIndex': startIndex,
      'rowCounts': totalItemPerPage
   };
   leaveStatusListAJAX(jsonInput, lvStInfoNextPage, false);
}