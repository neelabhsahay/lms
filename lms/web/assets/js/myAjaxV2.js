var siteURl = 'http://127.0.0.1:8000/';

function insertEmpAJAX(jsonInput, callBackFunc, skipFailure404) {
   var jwt = getCookie('jwt');
   //jsonInput['jwt'] = jwt;
   // Call Web API to get a list of Products
   $.ajax({
      url: siteURl + 'emp/create/',
      type: 'POST',
      headers: {
         Authorization: 'Bearer ' + jwt
      },
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
   var jwt = getCookie('jwt');
   // Call Web API to get a list of Products
   $.ajax({
      url: siteURl + 'emp/update/' + jsonInput['empId'],
      type: 'PUT',
      headers: {
         Authorization: 'Bearer ' + jwt
      },
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
   var jwt = getCookie('jwt');
   // Call Web API to get a list of Products
   $.ajax({
      url: siteURl + 'leave/create/',
      type: 'POST',
      headers: {
         Authorization: 'Bearer ' + jwt
      },
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
   var jwt = getCookie('jwt');
   // Call Web API to get a list of Products
   $.ajax({
      url: siteURl + 'leave/update/' + jsonInput['leaveId'],
      type: 'PUT',
      headers: {
         Authorization: 'Bearer ' + jwt
      },
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
   var jwt = getCookie('jwt');
   // Call Web API to get a list of Products
   $.ajax({
      url: siteURl + 'lvst/create/',
      type: 'POST',
      headers: {
         Authorization: 'Bearer ' + jwt
      },
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
   var jwt = getCookie('jwt');
   // Call Web API to get a list of Products
   $.ajax({
      url: siteURl + 'lvst/update/',
      type: 'PUT',
      headers: {
         Authorization: 'Bearer ' + jwt
      },
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
   var jwt = getCookie('jwt');
   // Call Web API to get a list of Products
   $.ajax({
      url: siteURl + 'user/create/',
      type: 'POST',
      headers: {
         Authorization: 'Bearer ' + jwt
      },
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
   var jwt = getCookie('jwt');
   // Call Web API to get a list of Products
   $.ajax({
      url: siteURl + 'user/update/' + jsonInput['username'],
      type: 'PUT',
      headers: {
         Authorization: 'Bearer ' + jwt
      },
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
   // Call Web API to get a list of Products
   $.ajax({
      url: siteURl + 'lvrq/me/',
      type: 'POST',
      headers: {
         Authorization: 'Bearer ' + jwt
      },
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
   var jwt = getCookie('jwt');
   // Call Web API to get a list of Products
   $.ajax({
      url: siteURl + 'lvrq/update/',
      type: 'POST',
      headers: {
         Authorization: 'Bearer ' + jwt
      },
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

function insertHolidayAJAX(jsonInput, callBackFunc, skipFailure404) {
   var jwt = getCookie('jwt');
   // Call Web API to get a list of Products
   $.ajax({
      url: siteURl + 'holiday/create/',
      type: 'POST',
      headers: {
         Authorization: 'Bearer ' + jwt
      },
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

function updateHolidayAJAX(jsonInput, callBackFunc, skipFailure404) {
   var jwt = getCookie('jwt');
   // Call Web API to get a list of Products
   $.ajax({
      url: siteURl + 'holiday/update/' + jsonInput['holidayId'],
      type: 'PUT',
      headers: {
         Authorization: 'Bearer ' + jwt
      },
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
 *  Read Section
 */

function leaveListAJAX(jsonInput, listCallBackFunc, skipFailure404) {
   var jwt = getCookie('jwt');
   let urlStr = siteURl + 'leave/get/';
   if (("leaveId" in jsonInput) == true) {
      urlStr = urlStr + jsonInput['leaveId'];
      delete jsonInput['leaveId'];
   }
   let url = createListURL(urlStr,
      jsonInput);
   // Call Web API to get a list of Products
   $.ajax({
      url: url,
      type: 'GET',
      headers: {
         Authorization: 'Bearer ' + jwt
      },
      dataType: 'json',
      contentType: "application/json; charset=utf-8",
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
   let urlStr = siteURl;
   if (("empId" in jsonInput) == true) {
      urlStr = urlStr + 'emp/get/' + jsonInput['empId'];
      delete jsonInput['empId'];
   } else {
      urlStr = urlStr + 'emp/active/'
   }
   let url = createListURL(urlStr,
      jsonInput);
   var jwt = getCookie('jwt');
   // Call Web API to get a list of Products
   $.ajax({
      url: url,
      type: 'GET',
      headers: {
         Authorization: 'Bearer ' + jwt
      },
      dataType: 'json',
      contentType: "application/json; charset=utf-8",
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

function getArchiveEmployeeAJAX(jsonInput, listCallBackFunc, skipFailure404) {
   let urlStr = siteURl + 'emp/archive/'
   let url = createListURL(urlStr, jsonInput);
   var jwt = getCookie('jwt');
   // Call Web API to get a list of Products
   $.ajax({
      url: url,
      type: 'GET',
      headers: {
         Authorization: 'Bearer ' + jwt
      },
      dataType: 'json',
      contentType: "application/json; charset=utf-8",
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
   let url = createListURL(siteURl + 'emp/search/' + jsonInput['key'],
      jsonInput);
   delete jsonInput['key'];
   var jwt = getCookie('jwt');
   // Call Web API to get a list of Products
   $.ajax({
      url: url,
      type: 'GET',
      headers: {
         Authorization: 'Bearer ' + jwt
      },
      dataType: 'json',
      contentType: "application/json; charset=utf-8",
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
   let url = createListURL(siteURl + 'lvst/get/',
      jsonInput);
   var jwt = getCookie('jwt');
   // Call Web API to get a list of Products
   $.ajax({
      url: url,
      type: 'GET',
      headers: {
         Authorization: 'Bearer ' + jwt
      },
      dataType: 'json',
      contentType: "application/json; charset=utf-8",
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
   let url = createListURL(siteURl + 'emp/me/',
      jsonInput);
   var jwt = getCookie('jwt');
   // Call Web API to get a list of Products
   $.ajax({
      url: url,
      type: 'GET',
      headers: {
         Authorization: 'Bearer ' + jwt
      },
      dataType: 'json',
      contentType: "application/json; charset=utf-8",
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

function loadProfileImageAJAX(callBackFunc) {
   var jwt = getCookie('jwt');
   $.ajax({
      url: siteURl + 'emp/myimage/',
      type: 'GET',
      headers: {
         Authorization: 'Bearer ' + jwt
      },
      success: function(response) {
         callBackFunc(response);
      },
      error: function(request, message, error) {
         handleException(request, message, error);
      }
   });
}

function uploadProfileImageAJAX(image, callBackFunc) {

   form = new FormData();
   form.append('file', image);
   var jwt = getCookie('jwt');
   $.ajax({
      url: siteURl + 'emp/myimage/',
      type: 'POST',
      headers: {
         Authorization: 'Bearer ' + jwt
      },
      data: form,
      dataType: 'json',
      cache: false,
      processData: false,
      //contentType: "multipart/form-data",
      contentType: false,
      type: 'POST',
      success: function(response) {
         callBackFunc(response);
      },
      error: function(request, message, error) {
         handleException(request, message, error);
      }
   });
}

// Get all Products to display
function myLeaveStatusAJAX(jsonInput, listCallBackFunc, skipFailure404) {
   let url = createListURL(siteURl + 'lvst/me/',
      jsonInput);
   var jwt = getCookie('jwt');
   // Call Web API to get a list of Products
   $.ajax({
      url: url,
      type: 'GET',
      headers: {
         Authorization: 'Bearer ' + jwt
      },
      dataType: 'json',
      contentType: "application/json; charset=utf-8",
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
   let url = createListURL(siteURl + 'lvrq/range/',
      jsonInput);
   var jwt = getCookie('jwt');
   // Call Web API to get a list of Products
   $.ajax({
      url: url,
      type: 'POST',
      headers: {
         Authorization: 'Bearer ' + jwt
      },
      dataType: 'json',
      contentType: "application/json; charset=utf-8",
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
   let url = createListURL(siteURl + 'lvrq/me/', jsonInput);
   var jwt = getCookie('jwt');
   // Call Web API to get a list of Products
   $.ajax({
      url: url,
      type: 'GET',
      headers: {
         Authorization: 'Bearer ' + jwt
      },
      dataType: 'json',
      contentType: "application/json; charset=utf-8",
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
   let url = createListURL(siteURl + 'lvrq/meapprove/', jsonInput);
   var jwt = getCookie('jwt');
   // Call Web API to get a list of Products
   $.ajax({
      url: url,
      type: 'POST',
      headers: {
         Authorization: 'Bearer ' + jwt
      },
      dataType: 'json',
      contentType: "application/json; charset=utf-8",
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
   let urlStr = siteURl + 'lvrq/get/';
   if (("reqId" in jsonInput) == true) {
      urlStr = urlStr + jsonInput['reqId'];
   }
   delete jsonInput['reqId'];
   let url = createListURL(urlStr, jsonInput);
   var jwt = getCookie('jwt');
   // Call Web API to get a list of Products
   $.ajax({
      url: url,
      type: 'GET',
      headers: {
         Authorization: 'Bearer ' + jwt
      },
      dataType: 'json',
      contentType: "application/json; charset=utf-8",
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
   // Call Web API to get a list of Products
   $.ajax({
      url: siteURl + 'lvrq/approve/',
      type: 'PUT',
      headers: {
         Authorization: 'Bearer ' + jwt
      },
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

function revokeLeaveRequestAJAX(jsonInput, callBackFunc, skipFailure404) {
   var jwt = getCookie('jwt');
   let urlStr = siteURl + 'lvrq/revoke/';
   if (("reqId" in jsonInput) == true) {
      urlStr = urlStr + jsonInput['reqId'];
   }
   delete jsonInput['reqId'];
   // Call Web API to get a list of Products
   $.ajax({
      url: urlStr,
      type: 'PUT',
      headers: {
         Authorization: 'Bearer ' + jwt
      },
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
   let url = createListURL(siteURl + 'user/get/',
      jsonInput);
   var jwt = getCookie('jwt');
   // Call Web API to get a list of Products
   $.ajax({
      url: url,
      type: 'GET',
      headers: {
         Authorization: 'Bearer ' + jwt
      },
      dataType: 'json',
      contentType: "application/json; charset=utf-8",
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
   let url = createListURL(siteURl + 'user/get/' + jsonInput['username'],
      jsonInput);
   delete jsonInput['username'];
   var jwt = getCookie('jwt');
   // Call Web API to get a list of Products
   $.ajax({
      url: url,
      type: 'GET',
      headers: {
         Authorization: 'Bearer ' + jwt
      },
      dataType: 'json',
      contentType: "application/json; charset=utf-8",
      data: JSON.stringify(jsonInput),

      success: function(response) {
         listCallBackFunc(response["body"], response["totalCount"]);
      },
      error: function(request, message, error) {
         handleException(request, message, error);
      }
   });
}

function holidayListAJAX(jsonInput, listCallBackFunc, skipFailure404) {
   var jwt = getCookie('jwt');
   let urlStr = siteURl + 'holiday/get/';
   if (("holidayId" in jsonInput) == true) {
      urlStr = urlStr + jsonInput['holidayId'];
      delete jsonInput['holidayId'];
   } else if (("year" in jsonInput) == true) {
      urlStr = urlStr + 'year/' + jsonInput['year'];
      delete jsonInput['year'];
   }
   let url = createListURL(urlStr,
      jsonInput);
   // Call Web API to get a list of Products
   $.ajax({
      url: url,
      type: 'GET',
      headers: {
         Authorization: 'Bearer ' + jwt
      },
      dataType: 'json',
      contentType: "application/json; charset=utf-8",
      data: JSON.stringify(jsonInput),
      success: function(response) {
         listCallBackFunc(response["body"], response["totalCount"]);
      },
      error: function(request, message, error) {
         if (skipFailure404 && request.status == "404") {
            listCallBackFunc("", "");
         } else {
            handleException(request, message, error);
         }
      }
   });
}

function loginToAppAJAX(jsonInput, callBackFunc, skipFailure404) {
   // Call Web API to get a list of Products
   $.ajax({
      url: siteURl + 'login/',
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