

// Get all Products to display
function lvStList() {
  var jwt = getCookie('jwt');
  // Call Web API to get a list of Products
  $.ajax({
    url: 'http://localhost/lms/api/emp/lvstread.php',
    type: 'POST',
    dataType: 'json',
    success: function (lvsts) {
      lvStInfo(lvsts["body"]);
    },
    error: function (request, message, error) {
      handleException(request, message, error);
    }
  });
}

function insertLeaveStatusAjax( leaveInfo ) {
  var jwt = getCookie('jwt');
  leaveInfo['jwt'] = jwt;
  console.log(JSON.stringify(leaveInfo));
  // Call Web API to get a list of Products
  $.ajax({
    url: 'http://localhost/lms/api/admin/lvstcreate.php',
    type: 'POST',
    dataType: 'json',
    data : JSON.stringify(leaveInfo),

    success: function (leaves) {
      alert( "Submitted");
    },
    error: function (request, message, error) {
      handleException(request, message, error);
    }
  });
}

function updateLeaveStatusAjax( leaveInfo ) {
  var jwt = getCookie('jwt');
  leaveInfo['jwt'] = jwt;
  console.log(JSON.stringify(leaveInfo));
  // Call Web API to get a list of Products
  $.ajax({
    url: 'http://localhost/lms/api/admin/lvstupdate.php',
    type: 'POST',
    dataType: 'json',
    data : JSON.stringify(leaveInfo),

    success: function (leaves) {
      alert( "Submitted");
    },
    error: function (request, message, error) {
      handleException(request, message, error);
    }
  });
}

function lvStInfo(lvsts) {
  $.each(lvsts, function (index, lvst) {
    // Add a row to the Product table
    lvStAddRow(lvst);
  });
}
// Add Product row to <table>
function lvStAddRow(lvst) {
  // First check if a <tbody> tag exists, add one if not
  if ($("#empTable tbody").length == 0) {
    $("#lvStTable").append("<tbody></tbody>");
  }
  // Append row to <table>
  $("#lvStTable tbody").append(
  lvStTableRow(lvst));
}
// Build a <tr> for a row of table data
function lvStTableRow(lvst) {
  var row = "<tr>";
          row = row +  "<td>" + lvst.empId + "</td>";
          row = row +  "<td>" + lvst.leaveId + "</td>";
          row = row +  "<td>" + lvst.year + "</td>";
          row = row +  "<td>" + lvst.leaveCarried + "</td>";
          row = row +  "<td>" + lvst.leaveInYear + "</td>";
          row = row +  "<td>" + lvst.leaveUsed + "</td>";
          row = row +  "<td>" + lvst.modifiedBy + "</td>";
          row = row +  "<td >";
          row = row +  "<button value='" + lvst.leaveId + "' ";
          row = row +  "class='btn btn-primary edit-item' onclick='viewLeave(this.value)'>Edit</button> " +
                       "<button value='" + lvst.leaveId + "' class='btn btn-info view-item' onclick='viewLeave(this.value)'>View</button>";
          row = row + "</td>";
          row = row + "</tr>";

      return row;
}

function clearLeaveStatusTableRow() {
    $("#lvStTable tbody").remove(); 
}

function loadListLeaveStatus() {
  clearLeaveStatusTableRow();
  lvStList();
}

function insertLeaveStatus() {
  var dataObj = $("#leaveStatusForm").serializeFormJSON();
  confirmAndExecute( insertLeaveStatusAjax, dataObj, "insert leave status");
  return false;
}

function updateLeaveStatus() {
  var dataObj = $("#upLeaveStatusForm").serializeFormJSON();
  confirmAndExecute( updateLeaveStatusAjax, dataObj, "update leave status");
  return false;
}

