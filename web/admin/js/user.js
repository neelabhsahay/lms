

// Get all Products to display
function usrList() {
  var jwt = getCookie('jwt');
  // Call Web API to get a list of Products
  $.ajax({
    url: 'http://localhost/lms/api/emp/usrread.php',
    type: 'GET',
    dataType: 'json',
    data : JSON.stringify({
        "jwt" : jwt
      }),
    success: function (products) {
      usrListSuccess(products);
    },
    error: function (request, message, error) {
      handleException(request, message, error);
    }
  });
}

// Get all Products to display
function userDetail( usr ) {
  var jwt = getCookie('jwt');
  // Call Web API to get a list of Products
  $.ajax({
    url: 'http://localhost/lms/api/emp/usrsigread.php',
    type: 'POST',
    dataType: 'json',
    data : JSON.stringify({
        "username" : usr,
        "jwt" : jwt
      }),

    success: function (usr) {
      fillUserForm(usr["body"][0]);
    },
    error: function (request, message, error) {
      handleException(request, message, error);
    }
  });
}

// Display all Products returned from Web API call
function usrListSuccess(products) {
  // Iterate over the collection of data
  $.each(products, function (index, product) {
    // Add a row to the Product table
    usrInfo(product);
  });
}
function usrInfo(usrs) {
  $.each(usrs, function (index, usr) {
    // Add a row to the Product table
    usrAddRow(usr);
  });
}
// Add Product row to <table>
function usrAddRow(usr) {
  // First check if a <tbody> tag exists, add one if not
  if ($("#usrTable tbody").length == 0) {
    $("#usrTable").append("<tbody></tbody>");
  }
  // Append row to <table>
  $("#usrTable tbody").append(
    usrTableRow(usr));
}
// Build a <tr> for a row of table data
function usrTableRow(usr) {
  var row = "<tr>";
      row = row +  "<td>" + usr.empId + "</td>";
      row = row +  "<td>" + usr.username + "</td>";
      row = row +  "<td>" + usr.accountType + "</td>";
      row = row +  "<td>" + usr.passwordType + "</td>";
      row = row +  "<td>" + usr.email + "</td>";
      row = row +  "<td >";
      row = row +  "<button value='" + usr.username + "' class='btn btn-primary edit-item' onclick='viewUser(this.value)'>Edit</button> " +
                   "<button value='" + usr.username + "' class='btn btn-info view-item' onclick='viewUser(this.value)'>View</button>";
      row = row + "</td>";
      row = row + "</tr>";
  return row;
}

function clearUsrTableRow() {
    $("#usrTable tbody").remove(); 
}

function loadListUsr() {
  clearUsrTableRow();
  usrList();
  displayModal( "listUsrModal" );
}

function fillUserForm( emp ) {
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

function clearUserForm() {
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

function viewUser(id) {
  clearUserForm();
  userDetail(id);
  displayModal( "updateUsrModal" );
  closeModal( "listUsrModal" );
}
