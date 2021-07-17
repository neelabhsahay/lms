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
   $("#viewEmpForm").setFormDataFromJSON(emp[0]);

   var name = document.getElementById('viewName');
   var email = document.getElementById('viewEmail');
   name.textContent = emp[0].firstName + " " + emp[0].lastName;
   email.textContent = emp[0].email;
   displayModal('viewEmpModal');
}

function showMyInfoDetail() {
   var jsonInput = {};
   myInfoDetailAJAX(jsonInput, fillMyInfoForm, false);
}

function apply_pagination(totalPages, callBackFunction) {
   var myPagination = new Pagination({
      // Where to render this component
      container: $("#pagerDIV"),

      // Called when user change page by this component
      // contains one parameter with page number
      pageClickCallback: function(pageNumber) {
         callBackFunction(pageNumber);
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