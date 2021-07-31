function insertEmpCb(message, status, data) {
   BootstrapDialog.alert("Inserted Successfully.");
   document.getElementById("empForm").reset();
   loadListEmp();
   closeModal("insertEmpModal");
}

function updateEmpCb(message, status, data) {
   BootstrapDialog.alert("Updated Successfully.");
   document.getElementById("upEmpForm").reset();
   loadListEmp();
   closeModal("updateEmpModal");
}

function empInfos(emps, totalCount) {
   if (totalCount !== null) {
      totalEmpCount = totalCount;
      totalPage = Math.ceil(totalEmpCount / totalItemPerPage);
   }
   $.each(emps, function(index, emp) {
      // Add a row to the table
      empAddRow(emp);
   });
   apply_pagination(totalPage, loadListEmpByIndex);
}

function empInfoNextPage(emps, totalCount) {
   $.each(emps, function(index, emp) {
      // Add a row to the table
      empAddRow(emp);
   });
}

function fillEmpSearchOutput(result) {
   clearEmpTableRow();
   if (result.length != 0) {
      $.each(result, function(index, emp) {
         empAddRow(emp);
      });
   }
}

// Add Product row to <table>
function empAddRow(emp) {
   // First check if a <tbody> tag exists, add one if not
   if ($("#empTable tbody").length == 0) {
      $("#empTable").append("<tbody></tbody>");
   }
   // Append row to <table>
   $("#empTable tbody").append(
      empTableRow(emp));
}

// Build a <tr> for a row of table data
function empTableRow(emp) {
   var row = "<tr>";
   row = row + "<td>" + emp.empId + "</td>";
   row = row + "<td>" + emp.firstName + " ";
   row = row + emp.middleName + " ";
   row = row + emp.lastName + "</td>";
   row = row + "<td>" + emp.location + "</td>";
   row = row + "<td>" + emp.managerName + "</td>";
   row = row + "<td>" + emp.contact + "</td>";
   row = row + "<td>" + emp.email + "</td>";
   row = row + "<td >";
   row = row + "<button value='" + emp.empId + "' class='btn btn-primary edit-item btn-sm' onclick='viewEmp(this.value)'>Edit</button> " +
      "<button value='" + emp.empId + "' class='btn btn-info view-item btn-sm' onclick='showEmployeeDetail(this.value)'>View</button>";
   row = row + "</td>";
   row = row + "</tr>";
   return row;
}

function showEmployeeDetail(empId) {
   var jsonInput = {
      "empId": empId
   };
   getEmployeeAJAX(jsonInput, fillMyInfoForm, false);
}

function clearEmpTableRow() {
   $("#empTable tbody").remove();
}

function loadListEmp() {
   clearEmpTableRow();
   var jsonInput = {
      "getCount": true,
      "startIndex": 0,
      "rowCounts": totalItemPerPage
   };
   getEmployeeAJAX(jsonInput, empInfos, false);
}

function loadListEmpByIndex(pageNumber) {

   let startIndex = (pageNumber - 1) * totalItemPerPage;
   clearEmpTableRow();
   var jsonInput = {
      'startIndex': startIndex,
      'rowCounts': totalItemPerPage
   };
   getEmployeeAJAX(jsonInput, empInfoNextPage, false);
}


function fillEmpForm(emp, totalCount) {
   $("#upEmpForm").setFormDataFromJSON(emp[0]);
}

function clearEmpForm() {
   document.getElementById("upEmpForm").reset();
}

function viewEmp(id) {
   clearEmpForm();
   var jsonInput = {
      "empId": id
   };
   getEmployeeAJAX(jsonInput, fillEmpForm, false);
   displayModal("updateEmpModal");
}

function insertEmp() {
   var dataObj = $("#empForm").serializeFormJSON();
   confirmAndExecute(insertEmpAJAX, dataObj, insertEmpCb, "insert employee");
   return false;
}

function updateEmp() {
   var dataObj = $("#upEmpForm").serializeFormJSON();
   confirmAndExecute(updateEmpAJAX, dataObj, updateEmpCb, "update employee");
   return false;
}

function searchEmployee(empStr) {
   if (empStr.length != 0) {
      var jsonInput = {
         "key": empStr
      };
      searchEmployeeAJAX(jsonInput, fillEmpSearchOutput, true);
   }
}

function addNewEmployee() {
   displayModal('empProfilebtn');
   displayModal('insertEmpModal');
}

function fillMgrSearchOutput(result) {
   $("#searchOptions").empty();
   if (result.length != 0) {
      $.each(result, function(index, emp) {
         var name = emp.firstName + " " + emp.lastName;
         $("#searchOptions").append("<option data-value='" + emp.empId + "' value='" + name + "'></option>");
      });
   } else {}
}

function selectMgr(mgrId) {
   var mgrName = document.getElementById("managerName").value;
   var selectedOption = $("#searchOptions option[value='" + mgrName + "']").attr('data-value');
   document.getElementById(mgrId).value = selectedOption;
}

function searchManager(mgrStr) {
   $("#searchOptions").empty();
   if (mgrStr.length != 0) {
      var jsonInput = {
         "key": mgrStr
      };
      searchEmployeeAJAX(jsonInput, fillMgrSearchOutput, true);
   }
}