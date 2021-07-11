

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
    url: 'http://localhost/lms/api/emp/empread.php',
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

function insertEmpAjax( empInfo ) {
  var jwt = getCookie('jwt');
  empInfo['jwt'] = jwt;
  console.log(JSON.stringify(empInfo));
  // Call Web API to get a list of Products
  $.ajax({
    url: 'http://localhost/lms/api/admin/empcreate.php',
    type: 'POST',
    dataType: 'json',
    data : JSON.stringify(empInfo),

    success: function (response) {
      BootstrapDialog.alert("Inserted Successfully.");
      document.getElementById("empForm").reset();
    },
    error: function (request, message, error) {
      handleException(request, message, error);
    }
  });
}

function updateEmpAjax( empInfo ) {
  var jwt = getCookie('jwt');
  empInfo['jwt'] = jwt;
  console.log(JSON.stringify(empInfo));
  // Call Web API to get a list of Products
  $.ajax({
    url: 'http://localhost/lms/api/admin/empupdate.php',
    type: 'POST',
    dataType: 'json',
    data : JSON.stringify(empInfo),

    success: function (leaves) {
      BootstrapDialog.alert("Updated Successfully.");
      document.getElementById("upEmpForm").reset();
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
}


function fillEmpForm( emp ) {
  $("#upEmpForm").setFormData(emp);

}

function clearEmpForm() {
  document.getElementById("upEmpForm").reset();
}

function viewEmp(id) {
  clearEmpForm();
  empDetail(id);
  displayModal( "updateEmpModal" );
}

function insertEmp() {
  var dataObj = $("#empForm").serializeFormJSON();
  confirmAndExecute( insertEmpAjax, dataObj, "insert employee");
  return false;
}

function updateEmp() {
  var dataObj = $("#upEmpForm").serializeFormJSON();
  confirmAndExecute( updateEmpAjax, dataObj, "update employee");
  return false;
}