//CONTROLLA SE I DATI DI ACCESSO SONO VALIDI
function loginCheck() {
  "use strict";
  var user = document.getElementById('username').value;
  var pwd = document.getElementById('password').value;
  var check_1 = false;
  var check_2 = false;
  if (user === "") {
    document.getElementById('wrongUser').innerHTML = "Immetti lo username";
    document.getElementById('username').className = "invalid";
    check_1 = false;
    if (pwd === "") {
      document.getElementById('wrongPwd').innerHTML = "Immetti la password";
      document.getElementById('password').className = "invalid";
      check_2 = false;
    } else {
      document.getElementById('wrongPwd').innerHTML = "";
      document.getElementById('password').className = "";
      check_2 = true;
    }
  } else {
      document.getElementById('wrongUser').innerHTML = "";
      document.getElementById('username').className = "";
      check_1 = true;
      if (pwd === "") {
        document.getElementById('wrongPwd').innerHTML = "Immetti la password";
        document.getElementById('password').className = "invalid";
        check_2 = false;
      } else {
        document.getElementById('wrongPwd').innerHTML = "";
        document.getElementById('password').className = "";
        check_2 = true;
      }
  }
  if (check_1 && check_2) {
    document.getElementById('login_form').submit();
  }
}
//CANCELLA L'INPUT
function clearInput() {
  "use strict";
  //USERNAME
  document.getElementById('username').value = "";
  document.getElementById('wrongUser').innerHTML = "";
  document.getElementById('username').className = "";
  //PASSWORD
  document.getElementById('password').value = "";
  document.getElementById('wrongPwd').innerHTML = "";
  document.getElementById('password').className = "";
}
