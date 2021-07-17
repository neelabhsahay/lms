function insertLeaveStatusAjax(leaveInfo) {
   var jwt = getCookie('jwt');
   leaveInfo['jwt'] = jwt;
   console.log(JSON.stringify(leaveInfo));
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://localhost/lms/api/admin/lvstcreate.php',
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify(leaveInfo),

      success: function(leaves) {
         BootstrapDialog.alert("Inserted Successfully.");
         closeModal("insertLeaveStatusModal");
         loadListLeaveStatus();
      },
      error: function(request, message, error) {
         handleException(request, message, error);
      }
   });
}

function updateLeaveStatusAjax(leaveInfo) {
   var jwt = getCookie('jwt');
   leaveInfo['jwt'] = jwt;
   console.log(JSON.stringify(leaveInfo));
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://localhost/lms/api/admin/lvstupdate.php',
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify(leaveInfo),

      success: function(leaves) {
         BootstrapDialog.alert("Inserted Successfully.");
      },
      error: function(request, message, error) {
         handleException(request, message, error);
      }
   });
}

/*
 * List Section and on Load section
 **********************************
 */
function lvStInfo(lvsts) {
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
   row = row + "class='btn btn-primary edit-item' onclick='viewLeaveStatus(this.value)'>Edit</button>";
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
      "getCount": true
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
   confirmAndExecute(updateLeaveStatusAjax, dataObj, "update leave status");
   return false;
}


/*
 * Insert New section of code 
 *************************
 */

function insertLeaveStatus() {
   var dataObj = $("#leaveStatusForm").serializeFormJSON();
   confirmAndExecute(insertLeaveStatusAjax, dataObj, "insert leave status");
   return false;
}

function fillEmpSearchOutput(result) {
   var div = document.getElementById("searchedEmp");

   if (result.length != 0) {
      div.style.display = "block";
      var disp = "";
      $.each(result, function(index, emp) {
         var name = emp.firstName + " " + emp.lastName;
         disp = disp + "<div class='seachResultItem' id='" +
            emp.empId + "'onclick='selectEmployee(this.id, this.value )' value='" + name + "'><a>" + name + "</a></div>";
      });
      div.innerHTML = disp;
   } else {
      div.style.display = "none";
   }
}

function selectEmployee(mgrId, mgrName) {
   var mgrName = document.getElementById(mgrId).getAttribute("value");
   document.getElementById("searchedEmp").style.display = "none";
   document.getElementById("lvstEmpId").value = mgrId;
   document.getElementById("lvstEmployeeName").value = mgrName;

}

function searchEmpForLeave(empStr) {
   if (empStr.length != 0) {
      var jsonInput = {
         "key": empStr
      };
      searchEmployeeAJAX(jsonInput, fillEmpSearchOutput, true);
   } else {
      document.getElementById("searchedEmp").style.display = "none";
   }
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