function leaveListAJAX( jsonInput, callBackFunc, skipFailure404 ) {
  var jwt = getCookie('jwt');
  jsonInput['jwt'] = jwt;
  // Call Web API to get a list of Products
  $.ajax({
    url: 'http://localhost/lms/api/emp/leaveread.php',
    type: 'POST',
    dataType: 'json',
    data : JSON.stringify(jsonInput),
    success: function (response) {
      callBackFunc(response["body"] );
    },
    error: function (request, message, error) {
      if( skipFailure404 && request.status == "404" ) {
          callBackFunc("" );
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
    data : JSON.stringify(jsonInput),
    success: function (response) {
      callBackFunc(response["body"] );
    },
    error: function (request, message, error) {
      if( skipFailure404 && request.status == "404" ) {
          callBackFunc("" );
      } else {
          handleException(request, message, error);
      }
    }
  });
}


// Get all Products to display
function searchEmployeeAJAX( jsonInput, callBackFunc, skipFailure404 ) {
  var jwt = getCookie('jwt');
  jsonInput['jwt'] = jwt;
  // Call Web API to get a list of Products
  $.ajax({
    url: 'http://localhost/lms/api/emp/empsearch.php',
    type: 'POST',
    dataType: 'json',
    data : JSON.stringify(jsonInput),

    success: function ( response) {
      callBackFunc(response["body"] );
    },
    error: function (request, message, error) {
      if( skipFailure404 && request.status == "404" ) {
          callBackFunc("" );
      } else {
          handleException(request, message, error);
      }
    }
  });
}

function leaveStatusListAJAX( jsonInput, callBackFunc, skipFailure404 ) {
  var jwt = getCookie('jwt');
  jsonInput['jwt'] = jwt;
  // Call Web API to get a list of Products
  $.ajax({
    url: 'http://localhost/lms/api/emp/lvstread.php',
    type: 'POST',
    dataType: 'json',
    data : JSON.stringify(jsonInput),
    success: function (response) {
      callBackFunc(response["body"]);
    },
    error: function (request, message, error) {
      if( skipFailure404 && request.status == "404" ) {
          callBackFunc("" );
      } else {
          handleException(request, message, error);
      }
    }
  });
}

// Get all Products to display
function myInfoDetailAJAX( jsonInput, callBackFunc, skipFailure404 ) {
  var jwt = getCookie('jwt');
  jsonInput['jwt'] = jwt;
  // Call Web API to get a list of Products
  $.ajax({
    url: 'http://localhost/lms/api/emp/empmyread.php',
    type: 'POST',
    dataType: 'json',
    data : JSON.stringify(jsonInput),
    success: function (response) {
      callBackFunc(response["body"]);
    },
    error: function (request, message, error) {
      if( skipFailure404 && request.status == "404" ) {
          callBackFunc("" );
      } else {
          handleException(request, message, error);
      }
    }
  });
}

// Get all Products to display
function myLeaveStatusAJAX( jsonInput, callBackFunc, skipFailure404 ) {
  var jwt = getCookie('jwt');
  jsonInput['jwt'] = jwt;
  // Call Web API to get a list of Products
  $.ajax({
    url: 'http://localhost/lms/api/emp/lvstmyread.php',
    type: 'POST',
    dataType: 'json',
    data : JSON.stringify(jsonInput),
    success: function (response) {
      callBackFunc(response["body"]);
    },
    error: function (request, message, error) {
      if( skipFailure404 && request.status == "404" ) {
          callBackFunc("" );
      } else {
          handleException(request, message, error);
      }
    }
  });
}