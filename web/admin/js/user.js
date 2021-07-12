// Get all Products to display
function usrList() {
  var jwt = getCookie('jwt');
  // Call Web API to get a list of Products
  $.ajax({
    url: 'http://localhost/lms/api/emp/usrread.php',
    type: 'POST',
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
    url: 'http://localhost/lms/api/emp/usrssigread.php',
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

function updateUserAjax( userInfo ) {
  var jwt = getCookie('jwt');
  userInfo['jwt'] = jwt;
  console.log(JSON.stringify(userInfo));
  // Call Web API to get a list of Products
  $.ajax({
    url: 'http://localhost/lms/api/admin/usrscreate.php',
    type: 'POST',
    dataType: 'json',
    data : JSON.stringify(userInfo),

    success: function (response) {
      BootstrapDialog.alert("Inserted Successfully.");
      document.getElementById("userForm").reset();
      closeModal('insertUserModal');
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

function loadListUser() {
  clearUsrTableRow();
  usrList();
}

function fillUserForm( emp ) {
  $("#userForm").setFormData(emp);
}

function clearUserForm() {
  document.getElementById("userForm").reset();
}

function viewUser(id) {
  clearUserForm();
  userDetail(id);
  document.getElementById("insertUserbtn").innerHTML = "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspUPDATE <span class='glyphicon glyphicon-send'></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
  document.getElementById("username").readOnly = true;
  displayModal( "insertUserModal" );
}

function insertUser() {
  var dataObj = $("#userForm").serializeFormJSON();
  confirmAndExecute( updateUserAjax, dataObj, "update employee");
  return false;
}
