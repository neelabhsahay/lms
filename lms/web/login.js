function validateLoginForm() {
   var myForm = document.getElementById('login_form');
   var user = myForm["username"].value;
   var pass = myForm["password"].value;
   if (user == "" || pass == "") {
      alert("Username & passord are mandatory.");
      return false;
   }
}


function admitToApp(message, status, data) {
   if (status == "1") {
      setCookie("jwt", data['jwt'], 1);
      if (data['accountType'] == "ADM") {
         setTimeout(' window.location.href = "admin/empdashboard.php"; ', 200);
      } else {
         setTimeout(' window.location.href = "emp/dashboard.php"; ', 200);
      }
   } else {
      alert("Error");
   }
}

function loginUser() {
   ret = validateLoginForm();
   if (ret == false) {
      return false;
   }
   setCookie("jwt", "", 1);
   var myForm = document.getElementById('login_form');
   var jsonInput = {
      "username": myForm["username"].value,
      "password": myForm["password"].value
   }
   loginToAppAJAX(jsonInput, admitToApp, false);
   return false;
}