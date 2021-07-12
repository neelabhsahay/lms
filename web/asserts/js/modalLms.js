function closeModal( modalId) {
  var modal = document.getElementById(modalId);
  modal.style.display = "none";        
}
function displayModal( modalId ) {
  var modal = document.getElementById(modalId);
  modal.style.display = "block";        
}

function showLoginPage() {
  setCookie("jwt", "", 1);
  setTimeout(' window.location.href = "http://localhost/lms/web/login.php"; ',100);
}

/*
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  var modalEmp = document.getElementById("insertEmpModal");
  var modalLeave = document.getElementById("insertLeaveModal");
  var modalLeaveStatus = document.getElementById("insertLeaveStatusModal");
  if (event.target == modalEmp ||
      event.target == modalLeave ||
      event.target == modalLeaveStatus) {
    modalEmp.style.display = "none";
    modalLeave.style.display = "none";
    modalLeaveStatus.style.display = "none";
  }
}
*/

function confirmAndExecute( functionName, dataObj, msg ) {
     var message = 'Do you want to ' + msg + '?';
     BootstrapDialog.confirm({
            title: 'STATUS',
            message: message,
            type: BootstrapDialog.TYPE_PRIMARY,
            size: BootstrapDialog.SIZE_SMALL,
            btnCancelLabel: 'Cancel', 
            btnOKLabel: 'Submit', //
            btnOKClass: 'btn-success',
            cssClass: "status-message",
            callback: function(result) {
                if(result) {
                  isConfirmed=true;
                   console.log(isConfirmed);
                   functionName(dataObj);
                }else {
                    isConfirmed=false;
                    console.log(isConfirmed);
                }
            }
        });
}

// Handle exceptions from AJAX calls
function handleException(request, message, error) {
  var msg = "";

  msg += "Code: " + request.status + "\n";
  msg += "Text: " + request.statusText + "\n";
  if (request.responseJSON != null) {
    msg += "Message: " + request.responseJSON.message + "\n";
    if( request.status == "403" ) {
      msg += "Error: " + request.responseJSON.error + "\n";
    }
  }
  BootstrapDialog.alert(msg);
  if( request.status == "401" || request.status == "403" ) {
     setTimeout(' window.location.href = "http://localhost/lms/web/login.php"; ',100);
  } 
}

/*
 * Employee related code
 */

 // Get all Products to display
function myInfoDetail() {
  var jwt = getCookie('jwt');
  // Call Web API to get a list of Products
  $.ajax({
    url: 'http://localhost/lms/api/emp/empmyread.php',
    type: 'POST',
    dataType: 'json',
    data : JSON.stringify({
        "jwt": jwt
      }),

    success: function (empInfo) {
      fillMyInfoForm(empInfo["body"][0]);
    },
    error: function (request, message, error) {
      handleException(request, message, error);
    }
  });
}

function fillMyInfoForm( emp ) {
  $("#empForm").setFormData(emp);
  closeModal('empProfilebtn');
  displayModal('insertEmpModal');
}

function showEmployeeDetail() {
  myInfoDetail();
}