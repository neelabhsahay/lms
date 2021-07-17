var totalEmpCount = 10;
var totalItemPerPage = 5;
var totalPage = 2;
var firstPage = 0;
var currentPage = 0;

function insertEmpAjax(empInfo) {
   var jwt = getCookie('jwt');
   empInfo['jwt'] = jwt;
   console.log(JSON.stringify(empInfo));
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://localhost/lms/api/admin/empcreate.php',
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify(empInfo),

      success: function(response) {
         BootstrapDialog.alert("Inserted Successfully.");
         document.getElementById("empForm").reset();
         loadListEmp();
         closeModal("insertEmpModal");
      },
      error: function(request, message, error) {
         handleException(request, message, error);
      }
   });
}

function updateEmpAjax(empInfo) {
   var jwt = getCookie('jwt');
   empInfo['jwt'] = jwt;
   console.log(JSON.stringify(empInfo));
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://localhost/lms/api/admin/empupdate.php',
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify(empInfo),

      success: function(leaves) {
         BootstrapDialog.alert("Updated Successfully.");
         document.getElementById("upEmpForm").reset();
         loadListEmp();
         closeModal("updateEmpModal");
      },
      error: function(request, message, error) {
         handleException(request, message, error);
      }
   });
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
   apply_pagination(totalPage);
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
   row = row + "<button value='" + emp.empId + "' class='btn btn-primary edit-item' onclick='viewEmp(this.value)'>Edit</button> " +
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
   var jsonInput = {
      "getCount": true,
      "startIndex": 0,
      "rowCounts": totalItemPerPage,
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
   getEmployeeAJAX(jsonInput, empInfos, false);
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
   confirmAndExecute(insertEmpAjax, dataObj, "insert employee");
   return false;
}

function updateEmp() {
   var dataObj = $("#upEmpForm").serializeFormJSON();
   confirmAndExecute(updateEmpAjax, dataObj, "update employee");
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
   var div = document.getElementById("searchedMgr");

   if (result.length != 0) {
      div.style.display = "block";
      var disp = "";
      $.each(result, function(index, emp) {
         var name = emp.firstName + " " + emp.lastName;
         disp = disp + "<div class='seachResultItem' id='" +
            emp.empId + "' onclick='selectMgr(this.id, this.value )' value='" + name + "'><a>" + name + "</a></div>";
      });
      div.innerHTML = disp;
   } else {
      div.style.display = "none";
   }
}

function selectMgr(mgrId, mgrName) {
   var mgrName = document.getElementById(mgrId).getAttribute("value");
   document.getElementById("searchedMgr").style.display = "none";
   document.getElementById("managerId").value = mgrId;
   document.getElementById("managerName").value = mgrName;

}

function searchManager(mgrStr) {
   if (mgrStr.length != 0) {
      var jsonInput = {
         "key": mgrStr
      };
      searchEmployeeAJAX(jsonInput, fillMgrSearchOutput, true);
   } else {
      document.getElementById("searchedMgr").style.display = "none";
   }
}

/*
 * Paging section of code
 */

function apply_pagination(totalPages) {
   var myPagination = new Pagination({
      // Where to render this component
      container: $("#emplyeePages"),

      // Called when user change page by this component
      // contains one parameter with page number
      pageClickCallback: function(pageNumber) {
         loadListEmpByIndex(pageNumber);
      },

      // The URL to which is browser redirected after user change page by this component
      pageClickUrl: '',

      // If true, pageClickCallback is called immediately after component render (after make method call)
      callPageClickCallbackOnInit: false,

      // The number of visible buttons in pagination panel
      maxVisibleElements: 13,

      showInput: false,

      // The content of tooltip displayed on text input box.
      inputTitle: '',
      // If false, standard mode is used (show arrows on the edges, border page numbers, shorting dots and page numbers around current page).
      // If true, standard mode is enhanced, so page number between border number and middle area is also displayed.
      enhancedMode: true
   });
   var itemsCount = totalEmpCount;
   var itemsOnPage = totalItemPerPage;
   myPagination.make(itemsCount, itemsOnPage);
}