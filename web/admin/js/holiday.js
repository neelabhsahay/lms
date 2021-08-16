function insertHolidayCb(message, status, data) {
   if (status == 'failed') {
      var msg = "";
      msg += "Reason: " + message + "\n";
      msg += "Text:" + "\n";
      msg += "\tFailure Reason: " + data.reason + "\n";
      BootstrapDialog.alert(msg);
   } else {
      BootstrapDialog.alert("Inserted Successfully.");
      document.getElementById("holidayForm").reset();
      closeModal('insertHolidayModal');
   }
}

function updateHolidayCb(message, status, data) {
   if (status == 'failed') {
      var msg = "";
      msg += "Reason: " + message + "\n";
      msg += "Text:" + "\n";
      msg += "\tFailure Reason: " + data.reason + "\n";
      BootstrapDialog.alert(msg);
   } else {
      BootstrapDialog.alert("Updated Successfully.");
      document.getElementById("holidayForm").reset();
      closeModal('insertHolidayModal');
   }
}

function insertUpdateHoliday() {
   var dataObj = $("#holidayForm").serializeFormJSON();
   if (document.getElementById("holidayBtn").value == "UPDATE") {
      confirmAndExecute(updateHolidayAJAX, dataObj, updateHolidayCb, "update the holiday details");
   } else {
      delete dataObj["holidayId"];
      confirmAndExecute(insertUpdateAJAX, dataObj, insertHolidayCb, "insert new holiday");
   }
   return false;
}


// Display all Products returned from Web API call
function holidayListSuccess(holidaysInfo, totalCount) {
   totalPage = 1
   if (totalCount !== 0) {
      totalEmpCount = totalCount;
      totalPage = Math.ceil(totalEmpCount / totalItemPerPage);
   }
   // Add a row to the Product table
   holidayInfo(holidaysInfo);
   apply_pagination(totalPage, loadListHolidayByIndex);
}

function holidayListNextPage(holidaysInfo, totalCount) {
   // Add a row to the Product table
   holidayInfo(holidaysInfo);
}

function holidayInfo(holidays) {
   $.each(holidays, function(index, holiday) {
      // Add a row to the Product table
      holidayAddRow(holiday);
   });
}
// Add Product row to <table>
function holidayAddRow(holiday) {
   // First check if a <tbody> tag exists, add one if not
   if ($("#listTable tbody").length == 0) {
      $("#listTable").append("<tbody></tbody>");
   }
   // Append row to <table>
   $("#listTable tbody").append(
      holidayTableRow(holiday));
}
// Build a <tr> for a row of table data
function holidayTableRow(holiday) {
   var row = "<tr>";
   row = row + "<td>" + holiday.holidayName + "</td>";
   row = row + "<td>" + holiday.holidayDate + "</td>";
   row = row + "<td>" + holiday.year + "</td>";
   row = row + "<td >";
   row = row + "<button value='" + holiday.holidayId + "' class='btn btn-primary edit-item btn-sm' onclick='viewHoiday(this.value)'>Edit</button> ";
   row = row + "</td>";
   row = row + "</tr>";
   return row;
}

function clearHolidayTableRow() {
   $("#listTable tbody").remove();
}

function listHolidayInyear(year) {
   clearHolidayTableRow();
   var jsonInput = {
      "getCount": true,
      "year": year
   };
   holidayListAJAX(jsonInput, holidayListSuccess, false);
}

function loadListHolidayByIndex(pageNumber) {
   let startIndex = (pageNumber - 1) * totalItemPerPage;
   clearHolidayTableRow();
   var jsonInput = {
      'startIndex': startIndex,
      'rowCounts': totalItemPerPage
   };
   holidayListAJAX(jsonInput, holidayListNextPage, false);
}

function fillHolidayForm(emp) {
   $("#holidayForm").setFormDataFromJSON(emp);
}

function clearHolidayForm() {
   document.getElementById("holidayForm").reset();
}

function viewHoiday(id) {
   clearHolidayForm();
   var jsonInput = {
      "holidayId": id
   };
   holidayListAJAX(jsonInput, holidayDetailCb, false);

}

function holidayDetailCb(resBody, totalCount) {
   fillHolidayForm(resBody[0]);
   document.getElementById("holidayBtn").value = "UPDATE";
   document.getElementById("holidayBtn").innerHTML = "UPDATE";
   document.getElementById("holidayId").readOnly = true;
   displayModal("insertHolidayModal");

}