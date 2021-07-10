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

// Handle exceptions from AJAX calls
function handleException(request, message, error) {
  var msg = "";

  msg += "Code: " + request.status + "\n";
  msg += "Text: " + request.statusText + "\n";
  if (request.responseJSON != null) {
    msg += "Message" + request.responseJSON.Message + "\n";
  }
  if( request.status == "401" ) {
    setTimeout(' window.location.href = "http://localhost/lms/web/login.php"; ',100);
  } else {
      alert(msg);
  }
}