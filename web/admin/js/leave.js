

// Get all Products to display
function leaveList() {
  var jwt = getCookie('jwt');
  // Call Web API to get a list of Products
  $.ajax({
    url: 'http://localhost/lms/api/emp/leaveread.php',
    type: 'POST',
    dataType: 'json',
    data : JSON.stringify({
      "jwt": jwt
    }),
    success: function (leaves) {
      leaveInfo(leaves["body"]);
    },
    error: function (request, message, error) {
      handleException(request, message, error);
    }
  });
}

// Get all Products to display
function leaveDetail( leaveId ) {
  var jwt = getCookie('jwt');
  // Call Web API to get a list of Products
  $.ajax({
    url: 'http://localhost/lms/api/emp/leavesigread.php',
    type: 'POST',
    dataType: 'json',
    data : JSON.stringify({
        "leaveId": leaveId,
        "jwt": jwt
      }),

    success: function (leaves) {
      fillLeaveForm(leaves["body"][0]);
    },
    error: function (request, message, error) {
      handleException(request, message, error);
    }
  });
}

function leaveInfo(leaves) {
  $.each(leaves, function (index, leave) {
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
      row = row +  "<td>" + leave.leaveId + "</td>";
      row = row +  "<td>" + leave.leaveType + "</td>";
      row = row +  "<td>" + leave.leaveMax + "</td>";
      row = row +  "<td>" + leave.leaveProvMax + "</td>";
      row = row +  "<td>" + leave.modifiedOn + "</td>";
      row = row +  "<td >";
      row = row +  "<button value='" + leave.leaveId + "' class='btn btn-primary edit-item' onclick='viewLeave(this.value)'>Edit</button> " +
                   "<button value='" + leave.leaveId + "' class='btn btn-info view-item' onclick='viewLeave(this.value)'>View</button>";
      row = row + "</td>";
      row = row + "</tr>";
  return row;
}

function clearLeaveTableRow() {
    $("#leaveTable tbody").remove(); 
}


function fillLeaveForm( leave ) {
  var updateLeaveId = document.getElementById('updateLeaveId');
  var updateLeaveType = document.getElementById('updateLeaveType');
  var updateLeaveMax = document.getElementById('updateLeaveMax');
  var updateLeaveProvMax = document.getElementById('updateLeaveProvMax');
  updateLeaveId.value = leave.leaveId;
  updateLeaveType.value = leave.leaveType;
  updateLeaveMax.value = leave.leaveMax;
  updateLeaveProvMax.value = leave.leaveProvMax;
}

function loadListLeave() {
  clearLeaveTableRow();
  leaveList();
  displayModal( "listLeaveModal" );
}

function viewLeave(id) {
  leaveDetail(id);
  //var leaveheader = document.getElementById('leaveheader');
  //leaveheader.innerHTML( "Update Leave" );
  displayModal( "updateLeaveModal" );
  closeModal( "listLeaveModal" );
}

