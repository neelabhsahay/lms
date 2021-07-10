

// Get all Products to display
function empList() {
  var jwt = getCookie('jwt');
  // Call Web API to get a list of Products
  $.ajax({
    url: 'http://localhost/lms/api/emp/empread.php',
    type: 'POST',
    dataType: 'json',
    success: function (emps) {
      empInfo(emps["body"]);
    },
    data : JSON.stringify({
        "jwt": jwt
      }),
    error: function (request, message, error) {
      handleException(request, message, error);
    }
  });
}

// Get all Products to display
function empDetail( empId ) {
  var jwt = getCookie('jwt');
  // Call Web API to get a list of Products
  $.ajax({
    url: 'http://localhost/lms/api/emp/empsigread.php',
    type: 'POST',
    dataType: 'json',
    data : JSON.stringify({
        "empId": empId,
        "jwt": jwt
      }),

    success: function (empId) {
      fillEmpForm(empId["body"][0]);
    },
    error: function (request, message, error) {
      handleException(request, message, error);
    }
  });
}

function empInfo(emps) {
  $.each(emps, function (index, emp) {
    // Add a row to the table
    empAddRow(emp);
  });
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
      row = row +          emp.middleName + " ";
      row = row +          emp.lastName + "</td>";
      row = row + "<td>" + emp.location + "</td>";
      row = row + "<td>" + emp.manager + "</td>";
      row = row + "<td>" + emp.contact + "</td>";
      row = row + "<td>" + emp.email + "</td>" ;
      row = row + "<td >";
      row = row +  "<button value='" + emp.empId + "' class='btn btn-primary edit-item' onclick='viewEmp(this.value)'>Edit</button> " +
                   "<button value='" + emp.empId + "' class='btn btn-info view-item' onclick='viewEmp(this.value)'>View</button>";
      row = row + "</td>";
      row = row + "</tr>";
  return row;
}

function clearEmpTableRow() {
    $("#empTable tbody").remove(); 
}

function loadListEmp() {
  clearEmpTableRow();
  empList();
  displayModal( "listEmpModal" );
}


function fillEmpForm( emp ) {
  var updateFirstName = document.getElementById('updateFirstName');
  var updateLastName = document.getElementById('updateLastName');
  var updateDepartmentId = document.getElementById('updateDepartmentId');
  var updateManager = document.getElementById('updateManager');
  var updateDateOfBirth = document.getElementById('updateDateOfBirth');
  var updateDateOfJoining = document.getElementById('updateDateOfJoining');
  var updateEmail = document.getElementById('updateEmail');
  var updateContactNo = document.getElementById('updateContactNo');
  var updateEmpId = document.getElementById('updateEmpId');

  updateFirstName.value     = emp.firstName;
  updateLastName.value      = emp.lastName;
  updateEmpId.value         = emp.empId;
  updateContactNo.value     = emp.contact;
  updateEmail.value         = emp.email;
  updateManager.value       = emp.manager;

  updateDepartmentId.value  = emp.departmentId;
  
  updateDateOfBirth.value   = emp.dateOfBirth;
  updateDateOfJoining.value = emp.dateOfJoin;
}

function clearEmpForm() {
  var updateFirstName = document.getElementById('updateFirstName');
  var updateLastName = document.getElementById('updateLastName');
  var updateDepartmentId = document.getElementById('updateDepartmentId');
  var updateManager = document.getElementById('updateManager');
  var updateDateOfBirth = document.getElementById('updateDateOfBirth');
  var updateDateOfJoining = document.getElementById('updateDateOfJoining');
  var updateEmail = document.getElementById('updateEmail');
  var updateContactNo = document.getElementById('updateContactNo');
  var updateEmpId = document.getElementById('updateEmpId');
  updateFirstName.value     = "";
  updateLastName.value      = "";
  updateDepartmentId.value  = "";
  updateManager.value       = "";
  updateDateOfBirth.value   = "";
  updateDateOfJoining.value = "";
  updateEmail.value         = "";
  updateContactNo.value     = "";
  updateEmpId.value         = "";
}

function viewEmp(id) {
  clearEmpForm();
  empDetail(id);
  displayModal( "updateEmpModal" );
  closeModal( "listEmpModal" );
}

