function insertEmpAJAX(jsonInput, callBackFunc, skipFailure404) {
   //var jwt = getCookie('jwt');
   //jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://127.0.0.1:8000/emp/create/',
      type: 'POST',
      dataType: 'json',
      contentType: "application/json; charset=utf-8",
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
   //var jwt = getCookie('jwt');
   //jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://127.0.0.1:8000/emp/update/' + jsonInput['empId'],
      type: 'PUT',
      dataType: 'json',
      contentType: "application/json; charset=utf-8",
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

function insertLeaveAJAX(jsonInput, callBackFunc, skipFailure404) {
   //var jwt = getCookie('jwt');
   //jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://127.0.0.1:8000/leave/create/',
      type: 'POST',
      dataType: 'json',
      contentType: "application/json; charset=utf-8",
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

function updateLeaveAJAX(jsonInput, callBackFunc, skipFailure404) {
   //var jwt = getCookie('jwt');
   //jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://127.0.0.1:8000/leave/update/' + jsonInput['leaveId'],
      type: 'PUT',
      dataType: 'json',
      contentType: "application/json; charset=utf-8",
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

function insertLeaveStatusAJAX(jsonInput, callBackFunc, skipFailure404) {
   //var jwt = getCookie('jwt');
   //jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://127.0.0.1:8000/lvst/create/',
      type: 'POST',
      dataType: 'json',
      contentType: "application/json; charset=utf-8",
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

function updateLeaveStatusAJAX(jsonInput, callBackFunc, skipFailure404) {
   //var jwt = getCookie('jwt');
   //jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://127.0.0.1:8000/lvst/update/',
      type: 'PUT',
      dataType: 'json',
      contentType: "application/json; charset=utf-8",
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

function insertUserAJAX(jsonInput, callBackFunc, skipFailure404) {
   //var jwt = getCookie('jwt');
   //jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://127.0.0.1:8000/user/create/',
      type: 'POST',
      dataType: 'json',
      contentType: "application/json; charset=utf-8",
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

function updateUserAJAX(jsonInput, callBackFunc, skipFailure404) {
   //var jwt = getCookie('jwt');
   //jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://127.0.0.1:8000/user/update/' + jsonInput['username'],
      type: 'POST',
      dataType: 'json',
      contentType: "application/json; charset=utf-8",
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
      contentType: "application/json; charset=utf-8",
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
   //var jwt = getCookie('jwt');
   //jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: 'http://127.0.0.1:8000/lvrq/update/',
      type: 'POST',
      dataType: 'json',
      contentType: "application/json; charset=utf-8",
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
   //var jwt = getCookie('jwt');
   let urlStr = "http://127.0.0.1:8000/leave / get/";
   if (("leaveId" in jsonInput) == true) {
      urlStr = urlStr + jsonInput['leaveId'];
      delete jsonInput['leaveId'];
   }
   let url = createListURL(urlStr,
      jsonInput);
   //jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: url,
      type: 'GET',
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
   let urlStr = "http://127.0.0.1:8000/emp/get/";
   if (("empId" in jsonInput) == true) {
      urlStr = urlStr + jsonInput['empId'];
      delete jsonInput['empId'];
   }
   let url = createListURL(urlStr,
      jsonInput);
   console.log(url);
   //var jwt = getCookie('jwt');
   //jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: url,
      type: 'GET',
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
   let url = createListURL('http://127.0.0.1:8000/emp/search/' + jsonInput['key'],
      jsonInput);
   delete jsonInput['key'];
   //var jwt = getCookie('jwt');
   //jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: url,
      type: 'GET',
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
   let url = createListURL('http://localhost/lms/api/emp/lvstread.php',
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
   let url = createListURL('http://localhost/lms/api/emp/empmyread.php',
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
   let url = createListURL('http://localhost/lms/api/emp/lvstmyread.php',
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
   let url = createListURL('http://localhost/lms/api/emp/lvrqsrange.php',
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
   let url = createListURL('http://localhost/lms/api/emp/lvrqsmyhistory.php',
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
   let url = createListURL('http://localhost/lms/api/emp/lvrqsmyapprove.php',
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
   let urlStr = "http://127.0.0.1:8000/lvrq/get/";
   if (("leaveId" in jsonInput) == true) {
      urlStr = urlStr + jsonInput['leaveId'];
   }
   let url = createListURL(urlStr,
      jsonInput);
   //var jwt = getCookie('jwt');
   //jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: url,
      type: 'GET',
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
      url: 'http://localhost/lms/api/emp/approvereject.php',
      type: 'POST',
      dataType: 'json',
      contentType: "application/json; charset=utf-8",
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
      contentType: "application/json; charset=utf-8",
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
   let url = createListURL('http://localhost/lms/api/emp/usrread.php',
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
   let url = createListURL('http://localhost/lms/api/emp/usrssigread.php',
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