function closeModal(modalId) {
   var modal = document.getElementById(modalId);
   modal.style.display = "none";
}

function displayModal(modalId) {
   var modal = document.getElementById(modalId);
   modal.style.display = "block";
}

function showLoginPage() {
   setCookie("jwt", "", 1);
   setTimeout(' window.location.href = "http://localhost/lms/web/login.php"; ', 100);
}

function confirmAndExecute(functionName, dataObj, msg) {
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
         if (result) {
            isConfirmed = true;
            console.log(isConfirmed);
            functionName(dataObj);
         } else {
            isConfirmed = false;
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
      if (request.status == "403") {
         msg += "Error: " + request.responseJSON.error + "\n";
      }
   }
   BootstrapDialog.alert(msg);
   if (request.status == "401" || request.status == "403") {
      setTimeout(' window.location.href = "http://localhost/lms/web/login.php"; ', 100);
   }
}

function closeDisplayForm(modalId, formId) {
   closeModal(modalId);
   document.getElementById(formId).reset();
}

/*
 * Employee related code
 */



function fillMyInfoForm(emp) {
   $("#empForm").setFormDataFromJSON(emp[0]);
   closeModal('empProfilebtn');
   displayModal('insertEmpModal');
}

function showEmployeeDetail() {
   var jsonInput = {};
   myInfoDetailAJAX(jsonInput, fillMyInfoForm, false);
}