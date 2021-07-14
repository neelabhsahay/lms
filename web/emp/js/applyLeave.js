function setLeaveStatusContainer( index, enable, type, value ) {
  var arrCont = [ 'leaveCont1', 'leaveCont2' , 'leaveCont3',
                  'leaveCont4', 'leaveCont5'];
  var arrLabel = [ 'leave1', 'leave2' , 'leave3', 'leave4',
                   'leave5'];
  var arrValue = [ 'leaveValue1', 'leaveValue2', 'leaveValue3',
                   'leaveValue5', 'leaveValue5'];
  var lab = document.getElementById(arrLabel[index]);
  var val = document.getElementById(arrValue[index]);
  var con = document.getElementById(arrCont[index]);
  lab.innerHTML = type;
  val.innerHTML = "<a>" + value + "</a>";
  con.style.display = enable;
}

function updateAvaliableLeave( leaves ) {
  
  $.each(leaves, function (index, leave) {
    // Add a row to the Product table
    
    var y = Number(leave.leaveInYear) + Number(leave.leaveCarried);
    var u = y - Number(leave.leaveUsed);
    setLeaveStatusContainer( index, "block", leave.leaveType, u );
  });
}

function updateLeaveSelection( leaveList ) {
  var x = document.getElementById("leaveId");
  $.each(leaveList, function (index, leave) {
      var option = document.createElement("option");
      option.text = leave.leaveType;
      option.value= leave.leaveId;
      x.add(option);
  });
}


function selectLeaveDays( startDate, endDate) {
    //var stDate = document.getElementById('startDate');
    //var enDate = document.getElementById('endDate');
    //stDate.value = startDate;
    //enDate.value = endDate;
    displayModal('applyLeaveModal');
}

function selectLeaveOneDay( startDate ) {
  selectLeaveDays( startDate, startDate );
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
      dateClick: function(info) {
          selectLeaveOneDay( info.dateStr );
      },
      select: function(info) {
          selectLeaveDays( info.startStr, info.endStr);
      },
      datesSet: function(dateInfo){
        var currentdate = dateInfo.startStr;
        alert( "View Start " + currentdate );
      }
    });

    calendar.render();
  }

function showApplyLeaveForm() {
  document.getElementById("applyLeaveForm").reset();
  var jsonInput = {
  };
  leaveListAJAX(jsonInput, updateLeaveSelection, false);
  displayModal('applyLeaveModal');
}

function displayAvaliableLeaves() {

}

function loadMyLeave() {
    var date = new Date();
    var nowYear = date.getFullYear();
    var jsonInput = {
        "year" : nowYear
    };
    myLeaveStatusAJAX(jsonInput, updateAvaliableLeave, false)
}
