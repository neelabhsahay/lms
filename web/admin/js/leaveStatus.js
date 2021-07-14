

// Get all Products to display
function leaveStatusList() {
  var jwt = getCookie('jwt');
  // Call Web API to get a list of Products
  $.ajax({
    url: 'http://localhost/lms/api/emp/lvstread.php',
    type: 'POST',
    dataType: 'json',
    data : JSON.stringify({
        "jwt": jwt
      }),
    success: function (lvsts) {
      lvStInfo(lvsts["body"]);
    },
    error: function (request, message, error) {
      handleException(request, message, error);
    }
  });
}

// Get all Products to display
function leaveStatusDetail( leaveId, empId, year ) {
  var jwt = getCookie('jwt');
  // Call Web API to get a list of Products
  $.ajax({
    url: 'http://localhost/lms/api/emp/lvstread.php',
    type: 'POST',
    dataType: 'json',
    data : JSON.stringify({
        "leaveId": leaveId,
        "empId" : empId,
        "year" : year,
        "jwt": jwt
      }),

    success: function (leaves) {
      fillLeaveStatusForm(leaves["body"][0]);
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
      BootstrapDialog.alert("Inserted Successfully.");
      closeModal( "insertLeaveStatusModal" );
      loadListLeaveStatus();
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
      BootstrapDialog.alert("Inserted Successfully.");
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
          row = row +  "<td>" + lvst.employeeName + "</td>";
          row = row +  "<td>" + lvst.leaveType + "</td>";
          row = row +  "<td>" + lvst.year + "</td>";
          row = row +  "<td>" + lvst.leaveCarried + "</td>";
          row = row +  "<td>" + lvst.leaveInYear + "</td>";
          row = row +  "<td>" + lvst.leaveUsed + "</td>";
          row = row +  "<td >";
          row = row +  "<button value='" + lvst.leaveId + "+" + lvst.empId + "+" + lvst.year +"'";
          row = row +  "class='btn btn-primary edit-item' onclick='viewLeaveStatus(this.value)'>Edit</button>";
          row = row + "</td>";
          row = row + "</tr>";

      return row;
}

function clearLeaveStatusTableRow() {
    $("#lvStTable tbody").remove(); 
}

function loadListLeaveStatus() {
  clearLeaveStatusTableRow();
  leaveStatusList();
}

function fillLeaveStatusForm( leaveStatus ) {
  $("#upLeaveStatusForm").setFormData(leaveStatus);
}

function viewLeaveStatus( keys ) {
    var keyArr = keys.split("+");
    leaveStatusDetail(keyArr[0], keyArr[1], keyArr[2]);
    displayModal( "updateLeaveStatusModal" );
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


function fillEmpSearchOutput( result ) {
    var div = document.getElementById("searchedEmp");
    
    if( result.length != 0 ) {
        div.style.display = "block";
        var disp = "";
        $.each(result, function (index, emp) {
           var name = emp.firstName + " " + emp.lastName;
           disp = disp + "<div class='seachResultItem' id='" +
                  emp.empId + "' onclick='selectEmployee(this.id, this.value )' value='"+ name +"'><a>" + name + "</a></div>";
        });
        div.innerHTML = disp;
    } else {
        div.style.display = "none";
    }
}

function selectEmployee( mgrId, mgrName ) {
  var mgrName = document.getElementById(mgrId).getAttribute("value");
  document.getElementById("searchedEmp").style.display = "none";
  document.getElementById("lvstEmpId").value = mgrId;
  document.getElementById("lvstEmployeeName").value =  mgrName;

}

function searchEmpForLeave( empStr ) {
    if( empStr.length != 0 ) {
        var jsonInput = {
            "key": empStr
        };
        searchEmployeeAJAX(jsonInput, fillEmpSearchOutput, true );
     } else {
        document.getElementById("searchedEmp").style.display = "none";
     }
}


function updateLeavePresent( leaveList ) {
  var x = document.getElementById("lvstLeaveId");
  $.each(leaveList, function (index, leave) {
      var option = document.createElement("option");
      option.text = leave.leaveType;
      option.value= leave.leaveId;
      x.add(option);
  });
}


function displayInsertLeave() {
    var jsonInput = {
    };
    leaveListAJAX(jsonInput, updateLeavePresent, false );
    displayModal('insertLeaveStatusModal');
}