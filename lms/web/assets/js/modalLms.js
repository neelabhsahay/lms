var totalEmpCount = 10;
var totalItemPerPage = 10;

var myPagination;

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

function confirmAndExecute(functionName, dataObj, cb_function, msg) {
   var message = 'Do you want to ' + msg + '?';
   BootstrapDialog.confirm({
      title: 'CONFIRMATION',
      message: message,
      type: BootstrapDialog.TYPE_PRIMARY,
      size: BootstrapDialog.SIZE_SMALL,
      btnCancelLabel: 'No',
      btnOKLabel: 'Yes', //
      btnOKClass: 'btn-success',
      cssClass: "status-message",
      callback: function(result) {
         if (result) {
            isConfirmed = true;
            console.log(isConfirmed);
            functionName(dataObj, cb_function, false);
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

   var name = document.getElementById('viewNameProfile');
   var email = document.getElementById('viewEmail');
   name.textContent = emp[0].firstName + " " + emp[0].lastName;
   email.textContent = emp[0].email;
   displayModal('viewEmpModal');
}

function fillProfileImageInView(response) {
   var profilePic = document.getElementById('profilePicImg');
   profilePic.src = 'data:image/jpeg;base64,' + response.image;
}

function showMyInfoDetail() {
   var jsonInput = {};
   loadProfileImageAJAX(fillProfileImageInView);
   myInfoDetailAJAX(jsonInput, fillMyInfoForm, false);
}

function fillProfileImage(response) {
   var nameInfo = document.getElementById('viewNameInfo');
   nameInfo.textContent = 'Hi, ' + response.firstName;
   var profilePic = document.getElementById('profilePic');
   profilePic.src = 'data:image/jpeg;base64,' + response.image;
}

function loadProfileImage() {
   loadProfileImageAJAX(fillProfileImage);
}

function fillEmployeeSearchOutput(result) {
   $("#searchOptions").empty();
   if (result.length != 0) {
      $.each(result, function(index, emp) {
         var name = emp.firstName + " " + emp.lastName;
         $("#searchOptions").append("<option data-value='" + emp.empId + "' value='" + name + "'></option>");
      });
   } else {}
}

function selectEmployee(empIdId, empNameId) {
   var empName = document.getElementById(empNameId).value;
   var selectedOption = $("#searchOptions option[value='" + empName + "']").attr('data-value');
   document.getElementById(empIdId).value = selectedOption;
}

function searchEmployee(empStr) {
   $("#searchOptions").empty();
   if (empStr.length != 0) {
      var jsonInput = {
         "key": empStr
      };
      searchEmployeeAJAX(jsonInput, fillEmployeeSearchOutput, true);
   }
}

function apply_pagination(totalPages, callBackFunction) {
   myPagination = null;
   myPagination = new Pagination({
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

function closeImageCropModal() {
   var $modal = $('#modal');
   $modal.modal('hide');
}