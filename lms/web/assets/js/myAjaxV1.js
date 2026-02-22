var siteURl = 'http://localhost/lms/api/';

function insertEmpAJAX(jsonInput, callBackFunc, skipFailure404) {
   var jwt = getCookie('jwt');
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: siteURl + 'admin/empcreate.php',
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
      url: siteURl + 'admin/empupdate.php',
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
      url: siteURl + 'admin/leavecreate.php',
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
      url: siteURl + 'admin/leaveupdate.php',
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
      url: siteURl + 'admin/lvstcreate.php',
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
      url: siteURl + 'admin/lvstupdate.php',
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
      url: siteURl + 'admin/usrscreate.php',
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
      url: siteURl + 'admin/usrsupdate.php',
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
      url: siteURl + 'emp/lvrqsmycreate.php',
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
      url: siteURl + 'emp/lvrqsupdate.php',
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
   let url = createListURL(siteURl + 'emp/leaveread.php',
      jsonInput);
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
            listCallBackFunc("");
         } else {
            handleException(request, message, error);
         }
      }
   });
}

// Get all Products to display
function getEmployeeAJAX(jsonInput, listCallBackFunc, skipFailure404) {
   let url = createListURL(siteURl + 'emp/empread.php',
      jsonInput);
   var jwt = getCookie('jwt');
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: url,
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify(jsonInput),
      success: function(response) {
         listCallBackFunc(response["body"], response["totalCount"]);
      },
      error: function(request, message, error) {
         if (skipFailure404 && request.status == "404") {
            listCallBackFunc("");
         } else {
            handleException(request, message, error);
         }
      }
   });
}


// Get all Products to display
function searchEmployeeAJAX(jsonInput, listCallBackFunc, skipFailure404) {
   let url = createListURL(siteURl + 'emp/empsearch.php',
      jsonInput);
   var jwt = getCookie('jwt');
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
            listCallBackFunc("");
         } else {
            handleException(request, message, error);
         }
      }
   });
}

function leaveStatusListAJAX(jsonInput, listCallBackFunc, skipFailure404) {
   let url = createListURL(siteURl + 'emp/lvstread.php',
      jsonInput);
   var jwt = getCookie('jwt');
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: url,
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify(jsonInput),
      success: function(response) {
         listCallBackFunc(response["body"], response["totalCount"]);
      },
      error: function(request, message, error) {
         if (skipFailure404 && request.status == "404") {
            listCallBackFunc("");
         } else {
            handleException(request, message, error);
         }
      }
   });
}

// Get all Products to display
function myInfoDetailAJAX(jsonInput, listCallBackFunc, skipFailure404) {
   let url = createListURL(siteURl + 'emp/empmyread.php',
      jsonInput);
   var jwt = getCookie('jwt');
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
            listCallBackFunc("");
         } else {
            handleException(request, message, error);
         }
      }
   });
}

// Get all Products to display
function myLeaveStatusAJAX(jsonInput, listCallBackFunc, skipFailure404) {
   let url = createListURL(siteURl + 'emp/lvstmyread.php',
      jsonInput);
   var jwt = getCookie('jwt');
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
            listCallBackFunc("");
         } else {
            handleException(request, message, error);
         }
      }
   });
}

// Get all Products to display
function myLeaveRequestInRangeAJAX(jsonInput, listCallBackFunc, skipFailure404,
   passThroughData) {
   let url = createListURL(siteURl + 'emp/lvrqsrange.php',
      jsonInput);
   var jwt = getCookie('jwt');
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: url,
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify(jsonInput),
      success: function(response) {
         listCallBackFunc(response["body"], passThroughData);
      },
      error: function(request, message, error) {
         if (skipFailure404 && request.status == "404") {
            listCallBackFunc("");
         } else {
            handleException(request, message, error);
         }
      }
   });
}

// Get all Products to display
function myLeaveRequestAJAX(jsonInput, listCallBackFunc, skipFailure404) {
   let url = createListURL(siteURl + 'emp/lvrqsmyhistory.php',
      jsonInput);
   var jwt = getCookie('jwt');
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: url,
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify(jsonInput),
      success: function(response) {
         listCallBackFunc(response["body"], response["totalCount"]);
      },
      error: function(request, message, error) {
         if (skipFailure404 && request.status == "404") {
            listCallBackFunc("");
         } else {
            handleException(request, message, error);
         }
      }
   });
}

// Get all Products to display
function myLeaveRequestForApproveAJAX(jsonInput, listCallBackFunc, skipFailure404) {
   let url = createListURL(siteURl + 'emp/lvrqsmyapprove.php',
      jsonInput);
   var jwt = getCookie('jwt');
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: url,
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify(jsonInput),
      success: function(response) {
         listCallBackFunc(response["body"], response["totalCount"]);
      },
      error: function(request, message, error) {
         if (skipFailure404 && request.status == "404") {
            listCallBackFunc("");
         } else {
            handleException(request, message, error);
         }
      }
   });
}


// Get all Products to display
function empLeaveRequestAJAX(jsonInput, listCallBackFunc, skipFailure404) {
   let url = createListURL(siteURl + 'emp/lvrqsread.php',
      jsonInput);
   var jwt = getCookie('jwt');
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: url,
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify(jsonInput),
      success: function(response) {
         listCallBackFunc(response["body"], response["totalCount"]);
      },
      error: function(request, message, error) {
         if (skipFailure404 && request.status == "404") {
            listCallBackFunc("");
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
      url: siteURl + 'emp/approvereject.php',
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
      url: siteURl + 'emp/revokelvrqs.php',
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
   let url = createListURL(siteURl + 'emp/usrread.php',
      jsonInput);
   var jwt = getCookie('jwt');
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: url,
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify(jsonInput),
      success: function(response) {
         listCallBackFunc(response["body"], response["totalCount"]);
      },
      error: function(request, message, error) {
         if (skipFailure404 && request.status == "404") {
            listCallBackFunc("");
         } else {
            handleException(request, message, error);
         }
      }
   });
}

function userDetailAJAX(jsonInput, listCallBackFunc, skipFailure404) {
   let url = createListURL(siteURl + 'emp/usrssigread.php',
      jsonInput);
   var jwt = getCookie('jwt');
   jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: url,
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

function loginToAppAJAX(jsonInput, callBackFunc, skipFailure404) {
   // Call Web API to get a list of Products
   $.ajax({
      url: siteURl + 'login.php',
      type: 'POST',
      contentType: 'application/json',
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