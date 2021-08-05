// Get all Products to display


function insertUserCb(message, status, data) {
   BootstrapDialog.alert("Inserted Successfully.");
   document.getElementById("userForm").reset();
   closeModal('insertUserModal');
}

function updateUserCb(message, status, data) {
   BootstrapDialog.alert("Inserted Successfully.");
   document.getElementById("userForm").reset();
   closeModal('insertUserModal');
}

// Display all Products returned from Web API call
function usrListSuccess(usersInfo, totalCount) {
   if (totalCount !== 0) {
      totalEmpCount = totalCount;
      totalPage = Math.ceil(totalEmpCount / totalItemPerPage);
   }
   // Add a row to the Product table
   usrInfo(usersInfo);
   apply_pagination(totalPage, loadListUserByIndex);
}

function usrListNextPage(usersInfo, totalCount) {
   // Add a row to the Product table
   usrInfo(usersInfo);
}

function usrInfo(usrs) {
   $.each(usrs, function(index, usr) {
      // Add a row to the Product table
      usrAddRow(usr);
   });
}
// Add Product row to <table>
function usrAddRow(usr) {
   // First check if a <tbody> tag exists, add one if not
   if ($("#listTable tbody").length == 0) {
      $("#listTable").append("<tbody></tbody>");
   }
   // Append row to <table>
   $("#listTable tbody").append(
      usrTableRow(usr));
}
// Build a <tr> for a row of table data
function usrTableRow(usr) {
   var row = "<tr>";
   row = row + "<td>" + usr.empId + "</td>";
   row = row + "<td>" + usr.username + "</td>";
   row = row + "<td>" + usr.accountType + "</td>";
   row = row + "<td>" + usr.passwordType + "</td>";
   row = row + "<td>" + usr.email + "</td>";
   row = row + "<td >";
   row = row + "<button value='" + usr.username + "' class='btn btn-primary edit-item btn-sm' onclick='viewUser(this.value)'>Edit</button> " +
      "<button value='" + usr.username + "' class='btn btn-info view-item btn-sm' onclick='viewUser(this.value)'>View</button>";
   row = row + "</td>";
   row = row + "</tr>";
   return row;
}

function clearUsrTableRow() {
   $("#listTable tbody").remove();
}

function loadListUser() {
   clearUsrTableRow();
   var jsonInput = {
      "getCount": true
   };
   usrListAJAX(jsonInput, usrListSuccess, false);
}

function loadListUserByIndex(pageNumber) {
   let startIndex = (pageNumber - 1) * totalItemPerPage;
   clearUsrTableRow();
   var jsonInput = {
      'startIndex': startIndex,
      'rowCounts': totalItemPerPage
   };
   usrListAJAX(jsonInput, usrListNextPage, false);
}

function fillUserForm(emp) {
   $("#userForm").setFormDataFromJSON(emp);
}

function clearUserForm() {
   document.getElementById("userForm").reset();
}

function viewUser(id) {
   clearUserForm();
   var jsonInput = {
      "username": id
   };
   userDetailAJAX(jsonInput, userDetailCb, false);

}

function userDetailCb(resBody, totalCount) {
   fillUserForm(resBody[0]);
   document.getElementById("insertUserbtn").value = "UPDATE";
   document.getElementById("insertUserbtn").innerHTML = "UPDATE";
   document.getElementById("username").readOnly = true;
   displayModal("insertUserModal");

}

function insertUpdateUser() {
   var dataObj = $("#userForm").serializeFormJSON();
   if (document.getElementById("insertUserbtn").value == "UPDATE") {
      delete dataObj["password"];
      confirmAndExecute(updateUserAJAX, dataObj, updateUserCb, "update the user details");
   } else {
      confirmAndExecute(insertUserAJAX, dataObj, insertUserCb, "insert new user");
   }
   return false;
}