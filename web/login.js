// jQuery codes

// Get all Products to display
function loginToApp( username, password ) {
  
  // Call Web API to get a list of Products
  $.ajax({
    url: 'http://localhost/lms/api/login.php',
    type: 'POST',
    contentType : 'application/json',
    dataType: 'json',
    data : JSON.stringify({
        "username": username,
        "password" :password
      }),
    success: function (result) {
       admitToApp( result );
    },
    error: function (request, message, error) {
      handleException(request, message, error);
    }
  });
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




function validateLoginForm() {
  var myForm = document.getElementById('login_form');
  var user = myForm["username"].value;
  var pass = myForm["password"].value;
  if (user == "" || pass == "" ) {
    alert("Username & passord are mandatory.");
    return false;
  }
}


function admitToApp( result ) {
    if( result["success"] == "1") {
        setCookie("jwt", result.jwt, 1);
        if( result.accountType == "ADM" ) {
            setTimeout(' window.location.href = "admin/dashboard.php"; ',2000);
        } else {
            setTimeout(' window.location.href = "emp/dashboard.php"; ',2000);
        }
    } else {
        alert("Error");
    }
}

function loginUser() {
    ret = validateLoginForm();
    if( ret == false ) {
        return false;
    }
    setCookie("jwt", "", 1);
    var myForm = document.getElementById('login_form');
    var user = myForm["username"].value;
    var pass = myForm["password"].value;
    
    loginToApp( user, pass );
    return false;
}