function insertMyLeaveRequest(jsonInput, callBackFunc, skipFailure404) {
   var jwt = getCookie('jwt');
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://localhost/lms/api/emp/lvrqsmycreate.php',
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify(jsonInput),
      success: function(response) {
         callBackFunc(response["message"], response["status"],
            response['data']);
      },
      error: function(request, message, error) {
         handleException(request, message, error);
      }
   });
}

function updateEmpLeaveRequest(jsonInput, callBackFunc, skipFailure404) {
   var jwt = getCookie('jwt');
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://localhost/lms/api/emp/lvrqsupdate.php',
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify(jsonInput),
      success: function(response) {
         callBackFunc(response["body"]);
      },
      error: function(request, message, error) {
         if (skipFailure404 && request.status == "404") {
            callBackFunc("");
         } else {
            handleException(request, message, error);
         }
      }
   });
}

/*
 *  Read Section
 */

function leaveListAJAX(jsonInput, callBackFunc, skipFailure404) {
   var jwt = getCookie('jwt');
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://localhost/lms/api/emp/leaveread.php',
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify(jsonInput),
      success: function(response) {
         callBackFunc(response["body"]);
      },
      error: function(request, message, error) {
         if (skipFailure404 && request.status == "404") {
            callBackFunc("");
         } else {
            handleException(request, message, error);
         }
      }
   });
}

// Get all Products to display
function getEmployeeAJAX(jsonInput, callBackFunc, skipFailure404) {
   var jwt = getCookie('jwt');
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://localhost/lms/api/emp/empread.php',
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify(jsonInput),
      success: function(response) {
         callBackFunc(response["body"], response["totalCount"]);
      },
      error: function(request, message, error) {
         if (skipFailure404 && request.status == "404") {
            callBackFunc("");
         } else {
            handleException(request, message, error);
         }
      }
   });
}


// Get all Products to display
function searchEmployeeAJAX(jsonInput, callBackFunc, skipFailure404) {
   var jwt = getCookie('jwt');
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://localhost/lms/api/emp/empsearch.php',
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify(jsonInput),

      success: function(response) {
         callBackFunc(response["body"]);
      },
      error: function(request, message, error) {
         if (skipFailure404 && request.status == "404") {
            callBackFunc("");
         } else {
            handleException(request, message, error);
         }
      }
   });
}

function leaveStatusListAJAX(jsonInput, callBackFunc, skipFailure404) {
   var jwt = getCookie('jwt');
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://localhost/lms/api/emp/lvstread.php',
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify(jsonInput),
      success: function(response) {
         callBackFunc(response["body"], response["totalCount"]);
      },
      error: function(request, message, error) {
         if (skipFailure404 && request.status == "404") {
            callBackFunc("");
         } else {
            handleException(request, message, error);
         }
      }
   });
}

// Get all Products to display
function myInfoDetailAJAX(jsonInput, callBackFunc, skipFailure404) {
   var jwt = getCookie('jwt');
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://localhost/lms/api/emp/empmyread.php',
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify(jsonInput),
      success: function(response) {
         callBackFunc(response["body"]);
      },
      error: function(request, message, error) {
         if (skipFailure404 && request.status == "404") {
            callBackFunc("");
         } else {
            handleException(request, message, error);
         }
      }
   });
}

// Get all Products to display
function myLeaveStatusAJAX(jsonInput, callBackFunc, skipFailure404) {
   var jwt = getCookie('jwt');
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://localhost/lms/api/emp/lvstmyread.php',
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify(jsonInput),
      success: function(response) {
         callBackFunc(response["body"]);
      },
      error: function(request, message, error) {
         if (skipFailure404 && request.status == "404") {
            callBackFunc("");
         } else {
            handleException(request, message, error);
         }
      }
   });
}

// Get all Products to display
function myLeaveRequestInRangeAJAX(jsonInput, callBackFunc, skipFailure404,
   passThroughData) {
   var jwt = getCookie('jwt');
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://localhost/lms/api/emp/lvrqsrange.php',
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify(jsonInput),
      success: function(response) {
         callBackFunc(response["body"], passThroughData);
      },
      error: function(request, message, error) {
         if (skipFailure404 && request.status == "404") {
            callBackFunc("");
         } else {
            handleException(request, message, error);
         }
      }
   });
}

// Get all Products to display
function myLeaveRequestAJAX(jsonInput, callBackFunc, skipFailure404) {
   var jwt = getCookie('jwt');
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://localhost/lms/api/emp/lvrqsmyhistory.php',
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify(jsonInput),
      success: function(response) {
         callBackFunc(response["body"]);
      },
      error: function(request, message, error) {
         if (skipFailure404 && request.status == "404") {
            callBackFunc("");
         } else {
            handleException(request, message, error);
         }
      }
   });
}

// Get all Products to display
function empLeaveRequestAJAX(jsonInput, callBackFunc, skipFailure404) {
   var jwt = getCookie('jwt');
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://localhost/lms/api/emp/lvrqsread.php',
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify(jsonInput),
      success: function(response) {
         callBackFunc(response["body"], response["totalCount"]);
      },
      error: function(request, message, error) {
         if (skipFailure404 && request.status == "404") {
            callBackFunc("");
         } else {
            handleException(request, message, error);
         }
      }
   });
}

/*
 * USER SPECFIC
 */
// Get all Products to display
function usrListAJAX(jsonInput, callBackFunc, skipFailure404) {
   var jwt = getCookie('jwt');
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://localhost/lms/api/emp/usrread.php',
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify(jsonInput),
      success: function(response) {
         callBackFunc(response["body"], response["totalCount"]);
      },
      error: function(request, message, error) {
         if (skipFailure404 && request.status == "404") {
            callBackFunc("");
         } else {
            handleException(request, message, error);
         }
      }
   });
}