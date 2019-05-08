function checkInput() {
  //PRELEVA IL VALORE DELL'INPUT
  var name = document.getElementById("name").value;
  var surname = document.getElementById("surname").value;
  var email = document.getElementById("contact-email").value;
  var textarea = document.getElementById("request-textarea").value;
  //VA RIABILI DI CONTROLLO
  var check_1 = false;
  var check_2 = false;
  var check_3 = false;
  var check_4 = false;
  var pos = 0;
  //NOME
  if (name === "") {
    document.getElementById("errorName").innerHTML = "Non puoi lasciare vuoto questo campo";
    document.getElementById("name").className = "invalid";
    check_1 = false;
  } else {
    pos = name.search(/[^a-zA-Z|\s|']/g);
    //SE SEARCH >= 0, L'INPUT IMMESSO NON E'CORRETTO
    if (pos >= 0) {
      //STAMPA MESSAGGIO D'ERRORE
      document.getElementById("errorName").innerHTML = "Il nome deve contenere solo lettere";
      //IL CAMPO DIVENTA INVALIDO (ROSSO)
      document.getElementById("name").className = "invalid";
      //CONTROLLO -> FALSO
      check_1 = false;
    } else { //ALTRIMENTI OK
      //CANCELLA MESSAGGIO D'ERRORE
      document.getElementById("errorName").innerHTML = "";
      //IL CAMPO DIVENTA VALIDO (VERDE)
      document.getElementById("name").className = "valid";
      //CONTROLLO -> VERO
      check_1 = true;
    }
  }   
  //COGNOME    
  //SE VUOTO -> ERRORE
  if (surname === "") {
    //STAMPA MESSAGGIO D'ERRORE
    document.getElementById("errorSurname").innerHTML = "Non puoi lasciare vuoto questo campo";
    //IL CAMPO DIVENTA INVALIDO (ROSSO)
    document.getElementById("surname").className = "invalid";
    check_2 = false;
  } else {
    //L'INPUT MATCHA LA REGEX?
    pos = surname.search(/[^a-zA-Z|\s|']/g); 
    //SE SEARCH >= 0, L'INPUT IMMESSO NON E'CORRETTO
    if (pos >= 0) {
      //STAMPA MESSAGGIO D'ERRORE    
      document.getElementById("errorSurname").innerHTML = "Il cognome deve contenere solo lettere";
      //IL CAMPO DIVENTA INVALIDO (ROSSO)
      document.getElementById("surname").className = "invalid";
      //CONTROLLO -> FALSO
      check_2 = false;
    } else {
      //CANCELLA MESSAGGIO D'ERRORE
      document.getElementById("errorSurname").innerHTML = "";
      //IL CAMPO DIVENTA VALIDO (VERDE)
      document.getElementById("surname").className = "valid";
      //CONTROLLO -> FALSO
      check_2 = true;
    }
  }
  //EMAIL
  //SE VUOTO -> ERRORE
  if (email === "") {
    //STAMPA MESSAGGIO D'ERRORE
    document.getElementById("errorEmail").innerHTML = "Non puoi lasciare vuoto questo campo";
    //IL CAMPO DIVENTA INVALIDO (ROSSO)
    document.getElementById("contact-email").className = "invalid";
    check_3 = false;
  } else {
    //L'INPUT MATCHA LA REGEX?
    pos = email.search(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
    //SE SEARCH >= 0, L'INPUT IMMESSO NON E'CORRETTO
    if (pos != 0) {
      //STAMPA MESSAGGIO D'ERRORE
      document.getElementById("errorEmail").innerHTML = "Inserisci una email valida";
      //IL CAMPO DIVENTA INVALIDO (ROSSO)
      document.getElementById("contact-email").className = "invalid";
      //CONTROLLO -> FALSO
      check_3 = false;
    } else { //ALTRIMENTI OK
      //CANCELLA MESSAGGIO D'ERRORE
      document.getElementById("errorEmail").innerHTML = "";
      //IL CAMPO DIVENTA VALIDO (VERDE)
      document.getElementById("contact-email").className = "valid";
      //CONTROLLO -> VERO
      check_3 = true;
    }
  }
  if (textarea === "") {
    //STAMPA MESSAGGIO D'ERRORE
    document.getElementById("errorTextarea").innerHTML = "Non puoi lasciare vuoto questo campo";
    //IL CAMPO DIVENTA INVALIDO (ROSSO)
    document.getElementById("request-textarea").className = "invalid";
    check_4 = false;
  } else { //ALTRIMENTI OK
    //CANCELLA MESSAGGIO D'ERRORE
    document.getElementById("errorTextarea").innerHTML = "";
    //IL CAMPO DIVENTA VALIDO (VERDE)
    document.getElementById("request-textarea").className = "valid";
    //CONTROLLO -> VERO
    check_4 = true;
  }
  if (check_1 && check_2 && check_3 & check_4) {
    document.getElementById("contact-form").submit();
  }
}
