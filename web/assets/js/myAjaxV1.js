function insertEmpAJAX(jsonInput, callBackFunc, skipFailure404) {
   var jwt = getCookie('jwt');
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://localhost/lms/api/admin/empcreate.php',
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

function updateEmpAJAX(jsonInput, callBackFunc, skipFailure404) {
   var jwt = getCookie('jwt');
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://localhost/lms/api/admin/empupdate.php',
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify(jsonInput),

      success: function(leaves) {
         callBackFunc(response["message"], response["status"],
            response['data']);
      },
      error: function(request, message, error) {
         handleException(request, message, error);
      }
   });
}

function insertLeaveAJAX(jsonInput, callBackFunc, skipFailure404) {
   var jwt = getCookie('jwt');
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://localhost/lms/api/admin/leavecreate.php',
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify(jsonInput),
      success: function(leaves) {
         callBackFunc(response["message"], response["status"],
            response['data']);
      },
      error: function(request, message, error) {
         handleException(request, message, error);
      }
   });
}

function updateLeaveAJAX(jsonInput, callBackFunc, skipFailure404) {
   var jwt = getCookie('jwt');
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://localhost/lms/api/admin/leaveupdate.php',
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify(jsonInput),
      success: function(leaves) {
         callBackFunc(response["message"], response["status"],
            response['data']);
      },
      error: function(request, message, error) {
         handleException(request, message, error);
      }
   });
}

function insertLeaveStatusAJAX(jsonInput, callBackFunc, skipFailure404) {
   var jwt = getCookie('jwt');
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://localhost/lms/api/admin/lvstcreate.php',
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify(jsonInput),
      success: function(leaves) {
         callBackFunc(response["message"], response["status"],
            response['data']);
      },
      error: function(request, message, error) {
         handleException(request, message, error);
      }
   });
}

function updateLeaveStatusAJAX(jsonInput, callBackFunc, skipFailure404) {
   var jwt = getCookie('jwt');
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://localhost/lms/api/admin/lvstupdate.php',
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify(jsonInput),
      success: function(leaves) {
         callBackFunc(response["message"], response["status"],
            response['data']);
      },
      error: function(request, message, error) {
         handleException(request, message, error);
      }
   });
}

function insertUserAJAX(jsonInput, callBackFunc, skipFailure404) {
   var jwt = getCookie('jwt');
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://localhost/lms/api/admin/usrscreate.php',
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify(jsonInput),

      success: function(jsonInput, callBackFunc, skipFailure404) {
         callBackFunc(response["message"], response["status"],
            response['data']);
      },
      error: function(request, message, error) {
         handleException(request, message, error);
      }
   });
}

function updateUserAJAX(jsonInput, callBackFunc, skipFailure404) {
   var jwt = getCookie('jwt');
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://localhost/lms/api/admin/usrsupdate.php',
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

function insertMyLeaveRequestAJAX(jsonInput, callBackFunc, skipFailure404) {
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

function updateEmpLeaveRequestAJAX(jsonInput, callBackFunc, skipFailure404) {
   var jwt = getCookie('jwt');
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://localhost/lms/api/emp/lvrqsupdate.php',
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify(jsonInput),
      success: function(response) {
         callBackFunc(response["message"], response["status"],
            response['data']);
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

function leaveListAJAX(jsonInput, listCallBackFunc, skipFailure404) {
   var jwt = getCookie('jwt');
   //let url = "http://127.0.0.1:8000/getleave/";
   //if (("leaveId" in jsonInput) == true) {
   //   url = url + jsonInput['leaveId'];
   //}
   let url = 'http://localhost/lms/api/emp/leaveread.php';
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: url,
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify(jsonInput),
      success: function(response) {
         listCallBackFunc(response["body"]);
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
function getEmployeeAJAX(jsonInput, listCallBackFunc, skipFailure404) {
   var jwt = getCookie('jwt');
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://localhost/lms/api/emp/empread.php',
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify(jsonInput),
      success: function(response) {
         listCallBackFunc(response["body"], response["totalCount"]);
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
function searchEmployeeAJAX(jsonInput, listCallBackFunc, skipFailure404) {
   var jwt = getCookie('jwt');
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://localhost/lms/api/emp/empsearch.php',
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify(jsonInput),

      success: function(response) {
         listCallBackFunc(response["body"]);
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

function leaveStatusListAJAX(jsonInput, listCallBackFunc, skipFailure404) {
   var jwt = getCookie('jwt');
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://localhost/lms/api/emp/lvstread.php',
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify(jsonInput),
      success: function(response) {
         listCallBackFunc(response["body"], response["totalCount"]);
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
function myInfoDetailAJAX(jsonInput, listCallBackFunc, skipFailure404) {
   var jwt = getCookie('jwt');
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://localhost/lms/api/emp/empmyread.php',
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify(jsonInput),
      success: function(response) {
         listCallBackFunc(response["body"]);
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
function myLeaveStatusAJAX(jsonInput, listCallBackFunc, skipFailure404) {
   var jwt = getCookie('jwt');
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://localhost/lms/api/emp/lvstmyread.php',
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify(jsonInput),
      success: function(response) {
         listCallBackFunc(response["body"]);
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
function myLeaveRequestInRangeAJAX(jsonInput, listCallBackFunc, skipFailure404,
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
         listCallBackFunc(response["body"], passThroughData);
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
function myLeaveRequestAJAX(jsonInput, listCallBackFunc, skipFailure404) {
   var jwt = getCookie('jwt');
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://localhost/lms/api/emp/lvrqsmyhistory.php',
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify(jsonInput),
      success: function(response) {
         listCallBackFunc(response["body"], response["totalCount"]);
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
function myLeaveRequestForApproveAJAX(jsonInput, listCallBackFunc, skipFailure404) {
   var jwt = getCookie('jwt');
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://localhost/lms/api/emp/lvrqsmyapprove.php',
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify(jsonInput),
      success: function(response) {
         listCallBackFunc(response["body"], response["totalCount"]);
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
function empLeaveRequestAJAX(jsonInput, listCallBackFunc, skipFailure404) {
   var jwt = getCookie('jwt');
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://localhost/lms/api/emp/lvrqsread.php',
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify(jsonInput),
      success: function(response) {
         listCallBackFunc(response["body"], response["totalCount"]);
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

function approveLeaveRequestAJAX(jsonInput, callBackFunc, skipFailure404) {
   var jwt = getCookie('jwt');
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://localhost/lms/api/emp/approvereject.php',
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

function rejectLeaveRequestAJAX(jsonInput, callBackFunc, skipFailure404) {
   var jwt = getCookie('jwt');
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://localhost/lms/api/emp/revokelvrqs.php',
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

/*
 * USER SPECFIC
 */
// Get all Products to display
function usrListAJAX(jsonInput, listCallBackFunc, skipFailure404) {
   var jwt = getCookie('jwt');
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://localhost/lms/api/emp/usrread.php',
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify(jsonInput),
      success: function(response) {
         listCallBackFunc(response["body"], response["totalCount"]);
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

function userDetailAJAX(jsonInput, listCallBackFunc, skipFailure404) {
   var jwt = getCookie('jwt');
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://localhost/lms/api/emp/usrssigread.php',
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify(jsonInput),

      success: function(response) {
         listCallBackFunc(response["body"], response["totalCount"]);
      },
      error: function(request, message, error) {
         handleException(request, message, error);
      }
   });
}