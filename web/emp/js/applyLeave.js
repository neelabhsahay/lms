/*
 * Employee dashboard related
 ****************************
 */

function setLeaveStatusContainer(index, enable, type, value) {
   var arrCont = ['leaveCont1', 'leaveCont2', 'leaveCont3',
      'leaveCont4', 'leaveCont5'
   ];
   var arrLabel = ['leave1', 'leave2', 'leave3', 'leave4',
      'leave5'
   ];
   var arrValue = ['leaveValue1', 'leaveValue2', 'leaveValue3',
      'leaveValue5', 'leaveValue5'
   ];
   var lab = document.getElementById(arrLabel[index]);
   var val = document.getElementById(arrValue[index]);
   var con = document.getElementById(arrCont[index]);
   lab.innerHTML = type;
   val.innerHTML = "<a>" + value + "</a>";
   con.style.display = enable;
}

function myAvaliableLeave(leaves) {
   $.each(leaves, function(index, leave) {
      // Add a row to the Product table
      var y = Number(leave.leaveInYear) + Number(leave.leaveCarried);
      var u = y - Number(leave.leaveUsed);
      setLeaveStatusContainer(index, "block", leave.leaveType, u);
   });
}

function updateLeaveSelection(leaveList) {
   var x = document.getElementById("leaveId");
   $.each(leaveList, function(index, leave) {
      var option = document.createElement("option");
      option.text = leave.leaveType;
      option.value = leave.leaveId;
      x.add(option);
   });
}


function selectLeaveDays(startDate, endDate) {
   var stDate = document.getElementById('alStartDate');
   var enDate = document.getElementById('alEndDate');
   stDate.value = startDate;
   enDate.value = endDate;
   var count = calculateBusinessDays(startDate, endDate);
   var noOfDays = document.getElementById('alNoOfDays');
   noOfDays.value = count;
   showEmployeeApprover();
   displayLeavesTypes();
   displayModal('applyLeaveModal');
}

function selectLeaveOneDay(startDate) {
   selectLeaveDays(startDate, startDate);
}

function loadCalendar() {
   var calendarEl = document.getElementById('calendar');

   var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
         left: 'prev,next today',
         center: 'title',
         right: 'dayGridMonth'
      },
      navLinks: true, // can click day/week names to navigate views
      businessHours: true, // display business hours
      editable: true,
      selectable: true,
      //dateClick: function(info) {
      //  selectLeaveOneDay(info.dateStr);
      //},
      select: function(info) {
         selectLeaveDays(info.startStr, info.endStr);
      },
      datesSet: function(dateInfo) {
         calendar.removeAllEvents();
         myLeaveRequestInRange(calendar, dateInfo.startStr, dateInfo.endStr);
      },
      eventClick: function(eventInfo) {
         viewLeaveRequest(eventInfo.event.id);
      },
      selectOverlap: function(event) {
         return event.rendering === 'background';
      }
   });

   calendar.render();
}

function loadMyLeave() {
   var date = new Date();
   var nowYear = date.getFullYear();
   var jsonInput = {
      "year": nowYear
   };
   myLeaveStatusAJAX(jsonInput, myAvaliableLeave, false)
}

/*
 * Apply Leave Form selection
 *****************************
 */

function displayLeaveTypeOptions(leaveList) {
   var x = document.getElementById("alLeaveId");
   var length = x.options.length;
   for (i = length - 1; i >= 1; i--) {
      x.options[i] = null;
   }
   $.each(leaveList, function(index, leave) {
      var option = document.createElement("option");
      option.text = leave.leaveType;
      option.value = leave.leaveId;
      x.add(option);
   });
}

function displayEmpAprover(empl) {
   var emp = empl[0];
   var approver = document.getElementById('alApprover');
   var approverId = document.getElementById('alApproverId');
   approver.value = emp.managerName;
   approverId.value = emp.manager;
   var name = document.getElementById('name');
   var email = document.getElementById('email');
   name.textContent = emp.firstName + " " + emp.lastName;
   email.textContent = emp.email;
}

function displayLeavesTypes() {
   var jsonInput = {};
   leaveListAJAX(jsonInput, displayLeaveTypeOptions, false)
}

function showEmployeeApprover() {
   var jsonInput = {};
   myInfoDetailAJAX(jsonInput, displayEmpAprover, false);
}

/*
 * insert leave request section
 */

function sucessfullyAppliedLeave(message, status, data) {
   BootstrapDialog.alert("Inserted Successfully.");
   //TODO Update full calender event 
   closeDisplayForm('applyLeaveModal', 'applyLeaveForm');
}

function insertLeaveRequest(dataObj) {
   insertMyLeaveRequestAJAX(dataObj, sucessfullyAppliedLeave, false);
}

function applyForLeave() {
   var dataObj = $("#applyLeaveForm").serializeFormJSON();
   // add items
   const now = new Date();
   dataObj['appliedDate'] = now;
   dataObj['status'] = 'Pending';
   confirmAndExecute(insertLeaveRequest, dataObj, "", "apply for leave ");
   return false;
}

/*
 * Calendar add event
 */

function getMyAppliedLeaves() {
   var date = new Date();
   var nowYear = date.getFullYear();
   var jsonInput = {
      "year": nowYear
   };
   myLeaveStatusAJAX(jsonInput, myAvaliableLeave, false)
}

function createCalEvent(data, calendar) {
   var eventJason = {
      "id": data['reqId'],
      "start": data['startDate'],
      "end": data['endDate'],
      "title": data['leaveType'],
      "status": data['status'],
      "allDay": true,
      "display": 'background'
   }
   addEventOnCalendar(eventJason, calendar);
}

// eventJason = {
//    "id" : reqId,
//    "start" : startDate,
//    "end" : endDate,
//    "title" : leaveType,
//    "status" : status,   
//}
function addEventOnCalendar(eventJson, calendar) {
   if (eventJson['status'] == 'Approved') {
      eventJson['color'] = 'blue';
   } else {
      eventJson['color'] = 'green';
   }
   calendar.addEvent(eventJson);
}

function createCalEvents(events, calendar) {
   $.each(events, function(index, event) {
      createCalEvent(event, calendar);
   });
}


function myLeaveRequestInRange(calendar, rangeStart, rangeEnd) {
   var jsonInput = {
      "rangeStart": rangeStart,
      "rangeEnd": rangeEnd
   };
   myLeaveRequestInRangeAJAX(jsonInput, createCalEvents, true, calendar);
}