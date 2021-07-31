function insertLeaveCb(message, status, data) {
   BootstrapDialog.alert("Inserted Successfully.");
   document.getElementById("leaveForm").reset();
   loadListLeave();
   closeModal("insertLeaveModal");
}



function updateLeaveCb(message, status, data) {
   BootstrapDialog.alert("Updated Successfully.");
   loadListLeave();
   closeModal("updateLeaveModal");
}

function leaveInfo(leaves) {
   $.each(leaves, function(index, leave) {
      // Add a row to the Product table
      leaveAddRow(leave);
   });
}
// Add Product row to <table>
function leaveAddRow(leave) {
   // First check if a <tbody> tag exists, add one if not
   if ($("#leaveTable tbody").length == 0) {
      $("#leaveTable").append("<tbody></tbody>");
   }
   // Append row to <table>
   $("#leaveTable tbody").append(
      leaveTableRow(leave));
}
// Build a <tr> for a row of table data
function leaveTableRow(leave) {
   var row = "<tr>";
   row = row + "<td>" + leave.leaveId + "</td>";
   row = row + "<td>" + leave.leaveType + "</td>";
   row = row + "<td>" + leave.leaveMax + "</td>";
   row = row + "<td>" + leave.leaveProvMax + "</td>";
   row = row + "<td>" + leave.modifiedOn + "</td>";
   row = row + "<td >";
   row = row + "<button value='" + leave.leaveId + "' class='btn btn-primary edit-item btn-sm' onclick='viewLeave(this.value)'>Edit</button> " +
      "<button value='" + leave.leaveId + "' class='btn btn-info view-item btn-sm' onclick='viewLeave(this.value)'>View</button>";
   row = row + "</td>";
   row = row + "</tr>";
   return row;
}

function clearLeaveTableRow() {
   $("#leaveTable tbody").remove();
}


function fillLeaveForm(leave) {
   $("#upLeaveForm").setFormDataFromJSON(leave[0]);
}

function loadListLeave() {
   clearLeaveTableRow();
   var jsonInput = {};
   leaveListAJAX(jsonInput, leaveInfo, false);
}

function viewLeave(id) {
   var jsonInput = {
      "leaveId": id
   };
   leaveListAJAX(jsonInput, fillLeaveForm, false);
   displayModal("updateLeaveModal");
}

function insertLeave() {
   var dataObj = $("#leaveForm").serializeFormJSON();
   confirmAndExecute(insertLeaveAJAX, dataObj, insertLeaveCb, "insert leave");
   return false;
}

function updateLeave() {
   var dataObj = $("#upLeaveForm").serializeFormJSON();
   confirmAndExecute(updateLeaveAJAX, dataObj, updateLeaveCb, "update leave");
   return false;
}